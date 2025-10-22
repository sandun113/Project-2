<?php
$host = "localhost";
$user = "root"; // your db username
$pass = "";     // your db password
$db   = "library_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
?>
