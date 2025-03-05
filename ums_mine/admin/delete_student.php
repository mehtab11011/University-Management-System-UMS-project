<?php
include "../database/db.php";
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete_query = "DELETE FROM admin_students WHERE id='$id'";
    
    if (mysqli_query($conn, $delete_query)) {
        header("Location: search_student.php?msg=Student Deleted Successfully");
        exit();
    } else {
        header("Location: search_student.php?msg=Error Deleting Student");
        exit();
    }
} else {
    header("Location: search_student.php");
    exit();
}
?>
