<?php
session_start();

include('databaseConnection.php');

$loginName = $_POST["loginName"];
$loginPassword = $_POST["loginPassword"];
$loggedIn = 1;
if (isset($_POST["page"])){
$page = 1;
};

$sql="SELECT * FROM $loginTable WHERE loginName = :loginName";
$stmt = $conn->prepare($sql);
$stmt->execute([':loginName' => $loginName]);
$loginCheck = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($loginCheck) > 0 ){
    foreach ($loginCheck as $row) {
    $storedHashedPassword = $row['loginPassword'];
    $storedSalt = $row['loginSalt'];
    $storedAdmin = $row['loginAdmin'];
    $storedId = $row['id'];
    $saltedInputPassword = $loginPassword . $storedSalt;

    if (password_verify($saltedInputPassword, $storedHashedPassword)) {

        if (isset($storedAdmin)){
            setcookie("loginAdmin", $storedAdmin, time() + 3600, "/");
        }else{
            setcookie("loginAdmin", 0, time() + 3600, "/");
        };
        
        setcookie("loggedInCookie", 1 , time() + 3600,"/");
        setcookie("loginId", $storedId, time() + 3600,"/");
        
        if ($page == 1){
            $page = 0;
            header("location: ../index.php");
        }else {
            header("location: ../services.php");
        }

        
    } else {
        $_SESSION['badLogin'] = true;
        
        if ($page == 1){
            $page = 0;
            header("location: ../index.php");
        }else {
            header("location: ../services.php");
        }
    }
    
    }
   
} else {
    $_SESSION['badLogin'] = true;
    
    if ($page = 1){
        $page = 0;
        header("location: ../index.php");
    }else {
        header("location: ../services.php");
    }
}

?>