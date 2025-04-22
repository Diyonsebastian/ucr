<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("User not logged in. Please log in to book a test drive.");
}

$user_id = $_SESSION['user_id'];

include("db1connection.php");


$userStmt = $conn->prepare("SELECT username FROM users WHERE user_id = ?");
$userStmt->bind_param("i", $user_id);
$userStmt->execute();
$userResult = $userStmt->get_result();

if ($userResult->num_rows === 0) {
    die("User not found.");
}
$customer_name = $userResult->fetch_assoc()['username'];


$car_id = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);
$contact_number = filter_input(INPUT_POST, 'contact_number', FILTER_SANITIZE_STRING);
$preferred_date = filter_input(INPUT_POST, 'preferred_date', FILTER_SANITIZE_STRING);


if ($car_id === false || $car_id === null) {
    die("Error: Invalid or missing car_id.");
}
if (empty($contact_number)) {
    die("Error: Contact number is required.");
}
if (empty($preferred_date)) {
    die("Error: Preferred date is required.");
}
if (!preg_match("/^[0-9]{10}$/", $contact_number)) {
    die("Invalid contact number. Please enter a 10-digit number.");
}


$stmt = $conn->prepare("INSERT INTO test_drive_bookings (car_id, customer_name, contact_number, preferred_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $car_id, $customer_name, $contact_number, $preferred_date);

if ($stmt->execute()) {
    header("Location: bookings.php?success=1");
    exit();
} else {
    echo "Error booking test drive: " . $stmt->error;
}

$stmt->close();
$userStmt->close();
$conn->close();
?>