<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/admin.css">
    <title>Admin Dashboard</title>
</head>
<body>

<?php include "admin_header.php"; ?>
<?php include "admin_sidebar.php"; ?>

<!-- Main Section for Viewing Selected Operations -->
<main class="dashboard">
    <h2>Admin Dashboard</h2>
    <?php include "admin_operations.php"; ?>
</main>

<?php include "admin_footer.php"; ?>

</body>
</html>
