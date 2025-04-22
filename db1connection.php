<?php
$host = "localhost";
$dbname = "usedcar";
$username = "root";
$password = "root"; // Update this for your setup
$port = 3307;

$conn = new mysqli($host, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>