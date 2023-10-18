<?php
include('databaseConnection.php');
if (isset($_COOKIE['loginId'])){
    $loginId = $_COOKIE['loginId'];
} else {
    $loginId = 0;
}
$sql = "SELECT * FROM $loginTable WHERE id = :loginId";
$stmt = $conn->prepare($sql);
$stmt->execute([':loginId' => $loginId]);
$formDefault = $stmt->fetch(PDO::FETCH_ASSOC);

if ($formDefault !== false) {
    $formName = $formDefault["loginName"];
    $formPhone = $formDefault["loginPhone"];
    $formEmail = $formDefault["loginEmail"];
} else {
    // Handle the case where no record is found
    $formName = "";
    $formPhone = "";
    $formEmail = "";
}
?>
