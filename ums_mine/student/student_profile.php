<?php
session_start();
include "../database/db.php";

if (!isset($_SESSION["student_name"])) {
    header("Location: student_login.php");
    exit();
}

$name = $_SESSION["student_name"];
$sql = "SELECT name, roll_number, email, phone, department FROM admin_students WHERE name='$name'";
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
    <title>Student Profile</title>
</head>
<body>

    <?php include 'student_header.php'; ?>
    <div class="dashboard-container">
        <?php include 'student_sidebar.php'; ?>

        <div class="dashboard">
            <div class="info-box">
                <h2>Student Profile</h2>
                <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
                <p><strong>Roll Number:</strong> <?php echo $student['roll_number']; ?></p>
                <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
                <p><strong>Phone:</strong> <?php echo $student['phone']; ?></p>
                <p><strong>Department:</strong> <?php echo $student['department'] ?? 'Not Assigned'; ?></p>
            </div>
        </div>
    </div>

    <?php include 'student_footer.php'; ?>

</body>
</html>
