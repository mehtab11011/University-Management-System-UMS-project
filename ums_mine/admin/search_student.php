<?php
include "../database/db.php";
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$search_result = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $query = "SELECT * FROM admin_students WHERE name LIKE '%$search%' OR roll_number LIKE '%$search%'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $search_result[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/admin.css">
    <title>Search Student</title>
</head>
<body>

<?php include "admin_header.php"; ?>
<?php include "admin_sidebar.php"; ?>

<main class="dashboard">
    <h2>🔍 Search Student</h2>
    
    <form method="POST" class="admin-form">
        <input type="text" name="search" placeholder="Enter Name or Roll Number" required>
        <button type="submit">Search</button>
    </form>

    <?php if (!empty($search_result)) { ?>
        <table class="student-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Roll Number</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>CGPA</th>
                    <th>Dues</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($search_result as $student) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['name']); ?></td>
                        <td><?php echo htmlspecialchars($student['roll_number']); ?></td>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                        <td><?php echo htmlspecialchars($student['phone']); ?></td>
                        <td><?php echo htmlspecialchars($student['department']); ?></td>
                        <td><?php echo htmlspecialchars($student['cgpa']); ?></td>
                        <td><?php echo htmlspecialchars($student['dues']); ?></td>
                        <td><?php echo htmlspecialchars($student['status']); ?></td>
                        <td><?php echo htmlspecialchars($student['created_at']); ?></td>
                        <td>
                        <a href="edit_student.php?id=<?php echo urlencode($student['id']); ?>" class="neon-btn">Edit</a>
                        <a href="delete_student.php?id=<?php echo urlencode($student['id']); ?>" class="neon-btn red" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } elseif ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <p style="color: red; text-align: center; font-weight: bold;">No students found.</p>
    <?php } ?>
</main>

<?php include "admin_footer.php"; ?>
</body>
</html>
