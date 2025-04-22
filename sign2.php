<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "usedcar";
$port = "3307";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure required fields are set before accessing them
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : '';
    $phone = isset($_POST["phone"]) ? trim($_POST["phone"]) : '';
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : '';

    

    // Prepare SQL query
    $sql = "INSERT INTO users (username, phone, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $username, $phone, $email, $password);

    if ($stmt->execute()) {
        echo "<script>
                alert('Registration successful!');
                window.location.href='login.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $stmt->error . "');
                window.location.href='sign2.php';
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>
