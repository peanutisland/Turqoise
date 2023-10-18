<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TurquoiseDentalServices";
$appointmentsTable = "appointments";
$loginTable = "login";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>