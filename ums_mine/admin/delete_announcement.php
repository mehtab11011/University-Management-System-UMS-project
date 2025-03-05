<?php
include "../database/db.php";
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete_query = "DELETE FROM announcements WHERE id='$id'";
    
    if (mysqli_query($conn, $delete_query)) {
        header("Location: admin_announcements.php?msg=Announcement Deleted");
        exit();
    } else {
        header("Location: admin_announcements.php?msg=Error Deleting Announcement");
        exit();
    }
}
?>
