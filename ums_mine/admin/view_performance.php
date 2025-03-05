<?php
include "../database/db.php";
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$students = mysqli_query($conn, "SELECT * FROM admin_students");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/admin.css">
    <title>Student Performance</title>
</head>
<body>

<?php include "admin_header.php"; ?>
<?php include "admin_sidebar.php"; ?>

<main class="dashboard">
    <h2>📊 Student Performance</h2>
    
    <table class="student-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Roll Number</th>
                <th>Department</th>
                <th>CGPA</th>
                <th>Attendance (%)</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($student = mysqli_fetch_assoc($students)) { ?>
                <tr>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['roll_number']; ?></td>
                    <td><?php echo $student['department']; ?></td>
                    <td><?php echo $student['cgpa']; ?></td>
                    <td><?php echo rand(75, 100); ?>%</td> <!-- Random attendance percentage -->
                    <td>
                        <?php 
                        if ($student['cgpa'] >= 3.5) {
                            echo "<span style='color:lime;'>Excellent</span>";
                        } elseif ($student['cgpa'] >= 3.0) {
                            echo "<span style='color:yellow;'>Good</span>";
                        } else {
                            echo "<span style='color:red;'>Needs Improvement</span>";
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<?php include "admin_footer.php"; ?>
</body>
</html>
