<?php
session_start();

// Redirect to login if user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

include("db1connection.php");

// Fetch username
$userStmt = $conn->prepare("SELECT username FROM users WHERE user_id = ?");
$userStmt->bind_param("i", $user_id);
$userStmt->execute();
$userResult = $userStmt->get_result();
$customer_name = $userResult->num_rows > 0 ? $userResult->fetch_assoc()['username'] : null;
$userStmt->close();

// Handle case where user is not found
if (!$customer_name) {
    echo '<div class="message error"><span class="icon">❌</span><p>User not found. Please log in again.</p></div>';
    $conn->close();
    exit();
}

// Fetch previous bookings, ordered by booking_id DESC
$bookingsStmt = $conn->prepare("
    SELECT t.booking_id, t.car_id, c.title, t.contact_number, t.preferred_date 
    FROM test_drive_bookings t 
    JOIN cars_details c ON t.car_id = c.car_id 
    WHERE t.customer_name = ? 
    ORDER BY t.booking_id DESC
");
$bookingsStmt->bind_param("s", $customer_name);
$bookingsStmt->execute();
$bookingsResult = $bookingsStmt->get_result();
$bookings = $bookingsResult->fetch_all(MYSQLI_ASSOC);
$bookingsStmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
            padding: 20px;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            width: 100%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
        }
        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 800px;
            width: 100%;
            text-align: center;
            margin-top: 100px;
            animation: slideIn 0.8s ease-out;
        }
        @keyframes slideIn {
            0% { opacity: 0; transform: translateY(-50px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        h1 {
            font-size: 32px;
            color: #007bff;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
        .message {
            padding: 20px;
            border-radius: 10px;
            font-size: 18px;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-in;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .icon {
            font-size: 50px;
            margin-bottom: 15px;
        }
        .success .icon { color: #28a745; }
        .error .icon { color: #dc3545; }
        .receipts-section {
            margin-topーネ

System: 40px;
            text-align: left;
        }
        .receipts-section h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .receipt {
            background-color: #fff;
            border: 2px dashed #007bff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeIn 1s ease-in;
        }
        .receipt h3 {
            font-size: 20px;
            color: #007bff;
            margin-bottom: 10px;
        }
        .receipt p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }
        .no-receipts {
            font-size: 16px;
            color: #666;
            text-align: center;
            padding: 20px;
        }
        a.back-btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        a.back-btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        footer {
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <h2>Test Drive Booking</h2>
    </header>
    <div class="container">
        <h1>Booking Confirmation</h1>
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="message success">
                <span class="icon">✅</span>
                <p>Your test drive has been successfully booked!</p>
            </div>
        <?php else: ?>
           
        <?php endif; ?>
        <div class="receipts-section">
            <h2>Your Previous Bookings</h2>
            <?php if (count($bookings) > 0): ?>
                <?php foreach ($bookings as $booking): ?>
                    <div class="receipt">
                        <h3>Booking Receipt #<?php echo htmlspecialchars($booking['booking_id']); ?></h3>
                        <p><strong>Car:</strong> <?php echo htmlspecialchars($booking['title']); ?></p>
                        <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($booking['contact_number']); ?></p>
                        <p><strong>Preferred Date:</strong> <?php echo htmlspecialchars($booking['preferred_date']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-receipts">You have no previous bookings.</p>
            <?php endif; ?>
        </div>
        <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    </div>
</body>
</html>