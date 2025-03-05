<?php
session_start();
include "../database/db.php";
if (!isset($_SESSION["student_name"])) {
    header("Location: student_login.php");
    exit();
}

$sql = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/student.css">
    <title>Announcements</title>
</head>
<body>

    <?php include 'student_header.php'; ?>
    <div class="dashboard-container">
        <?php include 'student_sidebar.php'; ?>

        <div class="dashboard">
            <div class="info-box">
                <h2>Latest Announcements</h2>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="announcement">
                        <h3><?php echo $row['title']; ?></h3>
                        <p><?php echo $row['message']; ?></p>
                        <span class="date"><?php echo $row['created_at']; ?></span>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <?php include 'student_footer.php'; ?>

</body>
</html>
