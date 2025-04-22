<?php
session_start();

// Suppress deprecated and warning messages from being output to the browser
error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING);
ini_set("display_errors", "0");

if (!isset($_SESSION['user_id'])) {
    die("User not logged in. Please log in to book a test drive.");
}

$user_id = $_SESSION['user_id'];

include("db1connection.php");

// Fetch the customer name
$userStmt = $conn->prepare("SELECT username FROM users WHERE user_id = ?");
$userStmt->bind_param("i", $user_id);
$userStmt->execute();
$userResult = $userStmt->get_result();

if ($userResult->num_rows === 0) {
    die("User not found.");
}

$customer_name = $userResult->fetch_assoc()['username'];

// Fetch and sanitize input values
$car_id = filter_input(INPUT_POST, 'car_id', FILTER_VALIDATE_INT);
$contact_number = preg_replace("/[^0-9]/", "", $_POST['contact_number']);
$preferred_date = htmlspecialchars(trim($_POST['preferred_date']), ENT_QUOTES, 'UTF-8');

// Validate inputs
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

// Insert the booking into the database
$stmt = $conn->prepare("INSERT INTO test_drive_bookings (car_id, customer_name, contact_number, preferred_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $car_id, $customer_name, $contact_number, $preferred_date);

if ($stmt->execute()) {
    // Redirect after successful booking
    header("Location: bookings.php?success=1");
    exit();
} else {
    echo "Error booking test drive: " . $stmt->error;
}

$stmt->close();
$userStmt->close();
$conn->close();
?>
