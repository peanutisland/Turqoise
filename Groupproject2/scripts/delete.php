<?php 
include('databaseConnection.php');

    $id = $_POST['id'];
    $sql = "DELETE FROM appointments WHERE id = '$id'";
    $conn->exec($sql);
    header("Location: ../services.php");
?>