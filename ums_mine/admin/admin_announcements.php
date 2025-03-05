<?php
include "../database/db.php";
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $message_content = $_POST['message'];

    $query = "INSERT INTO announcements (title, message) VALUES ('$title', '$message_content')";
    
    if (mysqli_query($conn, $query)) {
        $message = "📢 Announcement posted!";
    } else {
        $message = "❌ Error: " . mysqli_error($conn);
    }
}

// Fetch announcements
$announcements = mysqli_query($conn, "SELECT * FROM announcements ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/admin.css">
    <title>Admin Announcements</title>
</head>
<body>

<?php include "admin_header.php"; ?>
<?php include "admin_sidebar.php"; ?>

<main class="dashboard">
    <h2>📢 Manage Announcements</h2>
    <p><?php echo $message; ?></p>

    <form method="POST" class="admin-form">
        <input type="text" name="title" placeholder="Announcement Title" required>
        <textarea name="message" placeholder="Enter Announcement Message" required></textarea>
        <button type="submit">Post Announcement</button>
    </form>

    <h3>📜 Recent Announcements</h3>
    <table class="student-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Message</th>
                <th>Posted On</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($announcements)) { ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="delete_announcement.php?id=<?php echo $row['id']; ?>" class="neon-btn" onclick="return confirm('Delete this announcement?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<?php include "admin_footer.php"; ?>
</body>
</html>
