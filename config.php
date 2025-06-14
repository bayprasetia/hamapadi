<?php
// error_reporting(E_ERROR);
$servername = "localhost";
$username = "root";
$password = "";
$dbname="hamapadi_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>