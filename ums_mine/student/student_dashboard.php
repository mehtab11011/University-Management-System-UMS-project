<?php
session_start();
include "../database/db.php";
if (!isset($_SESSION["student_name"])) {
    header("Location: student_login.php");
    exit();
}

$name = $_SESSION["student_name"];
$sql = "SELECT * FROM students WHERE name='$name'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "Unauthorized access!";
    exit();
}

$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/student.css">
    <title>Student Dashboard</title>
</head>
<body>

    <?php include 'student_header.php'; ?>
    <div class="dashboard-container">
        <?php include 'student_sidebar.php'; ?>

        <!-- Main Content -->
        <div class="dashboard">
            <div class="info-box">
                <h3>Welcome, <?php echo $student['name']; ?>!</h3>
                <p>Roll Number: <?php echo $student['roll_number']; ?></p>
            </div>
        </div>
    </div>
    <?php include 'student_footer.php'; ?>

</body>
</html>
