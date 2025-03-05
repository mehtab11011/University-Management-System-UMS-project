<?php
session_start();
include "../database/db.php";
if (!isset($_SESSION["student_name"])) {
    header("Location: student_login.php");
    exit();
}

$name = $_SESSION["student_name"];
$sql = "SELECT * FROM admin_students WHERE name='$name'";
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
    <title>CGPA & Dues</title>
</head>
<body>

    <?php include 'student_header.php'; ?>
    <div class="dashboard-container">
        <?php include 'student_sidebar.php'; ?>

        <div class="dashboard">
            <div class="info-box">
                <h2>CGPA & Dues</h2>
                <p><strong>Current CGPA:</strong> <?php echo $student['cgpa']; ?></p>
                <p><strong>Pending Dues:</strong> Rs. <?php echo $student['dues']; ?></p>
            </div>
        </div>
    </div>

    <?php include 'student_footer.php'; ?>

</body>
</html>
