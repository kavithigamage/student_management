<?php
    $conn = new mysqli("localhost","root","","student_management");

    if($conn -> connect_error){
        die("connection error: ". $conn->connect_error);
    }
?>