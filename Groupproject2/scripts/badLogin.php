<?php
$badLogin = $_SESSION['badLogin'];
$badRegister = $_SESSION['badRegister'];

if ($badRegister == true){
    echo '<script>alert("Name already exists in the system. Please choose another name."); </script>';
    $_SESSION['badRegister'] = false;
};
if ($badLogin == true){
    echo '<script>alert("Either the Name or Password is incorrect."); </script>';
    $_SESSION['badLogin'] = false;
};
?>
