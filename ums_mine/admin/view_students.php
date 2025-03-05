<?php
include "../database/db.php";
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$query = "SELECT * FROM admin_students";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/admin.css">
    <title>View Students</title>
</head>
<body>

<?php include "admin_header.php"; ?>
<?php include "admin_sidebar.php"; ?>

<main class="dashboard">
    <h2>📋 View Student List</h2>
    <table class="student-table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll Number</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Department</th>
            <th>CGPA</th>
            <th>Dues</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['roll_number']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td><?php echo $row['cgpa']; ?></td>
            <td><?php echo $row['dues']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
        <?php } ?>
    </table>
</main>

<?php include "admin_footer.php"; ?>

</body>
</html>
