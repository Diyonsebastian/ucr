<?php
// index.php

// Database configuration
$servername = "my-mysql";
$username = "root";  // replace with your DB username
$password = "root";  // replace with your DB password
$dbname = "usedcar";    // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to database on server 'my-mysql'.";

// You can now write your queries here using $conn

// Example: list all tables in the database (optional)
$result = $conn->query("SHOW TABLES");
if ($result) {
    echo "<br>Tables in database:<br>";
    while ($row = $result->fetch_row()) {
        echo $row[0] . "<br>";
    }
    $result->free();
}

// Close connection
$conn->close();
?>
