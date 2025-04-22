<?php
$host = "my-mysql";
$dbname = "usedcar";
$username = "root";
$password = "root"; // Update this for your setup


$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
