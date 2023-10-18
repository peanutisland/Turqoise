<?php
session_start();

include('databaseConnection.php');

$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$dentist = $_POST["dentist"];
$date = $_POST["date"];
$time = $_POST["time"];
$details = $_POST["details"];
$loginIdCookie = $_COOKIE["loginId"];
if (!isset($loginIdCookie)){
        $loginIdCookie = 0;
}
// Server-side form validation
$errors = array();

// Check if the name is empty
if (empty($name)) {
    $errors[] = "Please enter your name.";
}

// Check if the phone number is empty
if (empty($phone)) {
    $errors[] = "Please enter your phone number.";
}

// Check if the email is empty
if (empty($email)) {
    $errors[] = "Please enter your email.";
} else {
    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
}

// Check if the dentist is selected
if (empty($dentist)) {
    $errors[] = "Please select a dentist.";
}

// Check if the date is empty
if (empty($date)) {
    $errors[] = "Please select an appointment date.";
}

// Check if the time is empty
if (empty($time)) {
    $errors[] = "Please select an appointment time.";
}

// If there are any errors, display them as an alert and stop further processing
if (!empty($errors)) {
    $errorString = implode("\\n", $errors);
    echo "<script>alert('$errorString');</script>";
    exit;
}

$sql = "INSERT INTO $appointmentsTable (dbname, dbphone, dbemail,dbdentist, dbdate, dbtime, dbdetails,loginId)
        VALUES (:name, :phone, :email, :dentist, :date, :time, :details, :loginId)";

$stmt = $conn->prepare($sql);

$stmt->bindParam(':name', $name);
$stmt->bindParam(':phone', $phone);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':dentist', $dentist);
$stmt->bindParam(':date', $date);
$stmt->bindParam(':time', $time);
$stmt->bindParam(':details', $details);
$stmt->bindParam(':loginId', $loginIdCookie);

$stmt->execute();
header("location: ../services.php");

$conn->close();
?>

