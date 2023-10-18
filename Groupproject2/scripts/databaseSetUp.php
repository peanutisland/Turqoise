<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TurquoiseDentalServices";
$appointmentsTable = "appointments";

$loginTable = "login";
$adminUsername = "Admin";
$adminPhone = "0123456789";
$adminEmail = 'admin@email.com';
$adminPassword = "Password";
$salt = bin2hex(random_bytes(16));
$saltedPassword = $adminPassword . $salt;
$hashedPassword = password_hash($saltedPassword, PASSWORD_DEFAULT);
$adminBoolean = true;

$conn = new PDO("mysql:host=$servername;", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create the database
$conn->exec("CREATE DATABASE IF NOT EXISTS $dbname");


// Switch to the newly created database
$conn->exec("USE $dbname");

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS $appointmentsTable (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    dbname VARCHAR(30) NOT NULL,
    dbphone INT(30) NOT NULL,
    dbemail VARCHAR(50) NOT NULL,
    dbdentist VARCHAR(30) NOT NULL,
    dbdate DATE NOT NULL,
    dbtime TIME NOT NULL,
    dbdetails VARCHAR(30),
    loginId INT (6)
    )";


// use exec() because no results are returned
$conn->exec("$sql");


$sql = "CREATE TABLE IF NOT EXISTS $loginTable (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    loginName VARCHAR(30) NOT NULL,
    loginPhone INT(30) NOT NULL,
    loginEmail VARCHAR(50) NOT NULL,
    loginPassword VARCHAR(255) NOT NULL,
    loginSalt VARCHAR(255) NOT NULL,
    loginAdmin BOOLEAN NOT NULL
    )";

$conn->exec("$sql");

$sql = "INSERT INTO $loginTable (loginName, loginPhone, loginEmail, loginPassword, loginSalt, loginAdmin) 
        VALUES (:loginName, :loginPhone, :loginEmail, :loginPassword, :loginSalt, :loginAdmin)";

$stmt = $conn->prepare($sql);

$adminCheckSql = "SELECT loginAdmin FROM $loginTable WHERE loginAdmin = :loginAdmin";
$stmtcheck = $conn->prepare($adminCheckSql);
$stmtcheck->execute(['loginAdmin' => $adminBoolean]);
$adminCheck = $stmtcheck->fetchAll(PDO::FETCH_ASSOC);

if (count($adminCheck) === 0) {
    $stmt->bindParam(':loginName', $adminUsername);
    $stmt->bindParam(':loginPhone', $adminPhone);
    $stmt->bindParam(':loginEmail', $adminEmail);
    $stmt->bindParam(':loginPassword', $hashedPassword);
    $stmt->bindParam(':loginSalt', $salt);
    $stmt->bindParam(':loginAdmin', $adminBoolean);
    
    $stmt->execute();
}