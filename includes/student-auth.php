<?php
    include "auth.php";

    if($_SESSION['role'] !== 'student'){
        header("Location: ../login.php");
        exit();
    }
?>