<?php
$timeClashCheck = $_SESSION['tCC'];
if ($timeClashCheck == 1){
    echo '<Script>alert("The set time is within an hour of a booked time. Please change the date or time of the booking."); </script>';
    $_SESSION['tCC'] = 0;
}
?>