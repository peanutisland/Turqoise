<?php
include('databaseConnection.php');
include('sessionStart.php');

$regName = $_POST['regName'];
$regPassword = $_POST['regPassword'];
$regPhone = $_POST['regPhone'];
$regEmail = $_POST['regEmail'];
$salt = bin2hex(random_bytes(16));
$saltedPassword = $regPassword . $salt;
$hashedPassword = password_hash($saltedPassword, PASSWORD_DEFAULT);
$adminBoolean = false;
if (isset($_POST["page"])){
       $page = 1;
};

$sql = "SELECT COUNT(*) FROM $loginTable WHERE loginName = :regName";
$stmt = $conn->prepare($sql);
$stmt->execute([':regName' => $regName]);
$stmt->execute();
$count = $stmt->fetchColumn();

// Check if the username already exists
if ($count > 0) {
       $_SESSION['badRegister'] = true;
}else{

$sql = "INSERT INTO $loginTable (loginName, loginPhone, loginEmail, loginPassword, loginSalt, loginAdmin) 
       VALUES (:regName, :regPhone, :regEmail, :regPassword, :regSalt, :regAdmin)";

$stmt = $conn->prepare($sql);

$stmt->bindParam(':regName', $regName);
$stmt->bindParam(':regPhone', $regPhone);
$stmt->bindParam(':regEmail', $regEmail);
$stmt->bindParam(':regPassword', $hashedPassword);
$stmt->bindParam(':regSalt', $salt);
$stmt->bindParam(':regAdmin', $adminBoolean);

$stmt->execute();
 }
if ($page == 1){
       $page = 0;
       header("location: ../index.php");
   }else {
       header("location: ../services.php");
   } 
 echo var_dump($_SESSION['badRegister']);
?>