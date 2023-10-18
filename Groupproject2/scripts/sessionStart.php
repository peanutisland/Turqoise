<?php
session_start();

if (!isset($_SESSION['included_session_start'])) {
    $_SESSION['tCC'] = 0;
    $_SESSION['badLogin'] = false;
    $_SESSION['badRegister'] = false;
   
    if (!isset($_COOKIE['loginId'])) {
        setcookie("loginId", 0, time() + 3600, "/");
    }

    if (isset($_COOKIE['loggedInCookie'])) {
        $loggedInCookie = $_COOKIE['loggedInCookie'];
    } else {
        $loggedInCookie = 0;
        setcookie("loggedInCookie", 0, time() + 3600, "/");
    }

    $_SESSION['included_session_start'] = true;
}
?>
