<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "ums_db";

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

