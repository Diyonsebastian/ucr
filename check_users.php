<?php
$mysqli = new mysqli("my-mysql", "root", "root", "usedcar");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$result = $mysqli->query("SHOW TABLES");

echo "<h3>Tables in 'usedcar' database:</h3><ul>";
while ($row = $result->fetch_array()) {
    echo "<li>" . $row[0] . "</li>";
}
echo "</ul>";

$mysqli->close();
?>
