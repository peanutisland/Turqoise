<?php
// Start the session
session_start();

include('databaseConnection.php');

$formDate = $_POST["date"];
$formTime = $_POST["time"];
$formDentist = $_POST["dentist"];
$hour = 3600;
$formTimeStr = strtotime($formTime);
$i = 0;

$sql = "SELECT dbtime FROM $appointmentsTable WHERE dbdate = :formDate AND dbdentist = :formDentist ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':formDate', $formDate);
$stmt->bindParam(':formDentist', $formDentist);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if any rows were returned
if (count($result) > 0) {
    // Fetch the data from each row
    foreach ($result as $row) {
        $dbTime = $row['dbtime'];
        $dbTimeStr = strtotime($dbTime);

        $timeComparison = abs($dbTimeStr - $formTimeStr);
        if ($timeComparison <= $hour) {
            $timeCC = 1;
            $_SESSION['tCC'] = $timeCC;
            header("location: ../services.php");
            exit;
        }
        $i = $i + 1;

        if (count($result) >= $i) {
            include('input.php');
            header("location: ../services.php");
            exit;
        }
    }
} else {
    include('input.php');
}

?>