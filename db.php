<?php
$conn = mysqli_connect("localhost","root","","student_task_management");
if(!$conn){
    die("Database Connection Failed");
}
session_start();
?>
