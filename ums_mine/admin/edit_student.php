<?php
include "../database/db.php";
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: search_student.php");
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM admin_students WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $roll_number = $_POST['roll_number'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $cgpa = $_POST['cgpa'];
    $dues = $_POST['dues'];
    $status = $_POST['status'];

    $update_query = "UPDATE admin_students SET name='$name', roll_number='$roll_number', email='$email', phone='$phone', 
                     department='$department', cgpa='$cgpa', dues='$dues', status='$status' WHERE id='$id'";
    
    if (mysqli_query($conn, $update_query)) {
        $message = "Student updated successfully!";
    } else {
        $message = "Error updating student: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/admin.css">
    <title>Edit Student</title>
</head>
<body>

<?php include "admin_header.php"; ?>
<?php include "admin_sidebar.php"; ?>

<main class="dashboard">
    <h2>✏️ Edit Student</h2>
    <p><?php echo isset($message) ? $message : ''; ?></p>
    
    <form method="POST" class="admin-form">
        <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
        <input type="text" name="roll_number" value="<?php echo $student['roll_number']; ?>" required>
        <input type="email" name="email" value="<?php echo $student['email']; ?>" required>
        <input type="text" name="phone" value="<?php echo $student['phone']; ?>" required>
        <input type="text" name="department" value="<?php echo $student['department']; ?>" required>
        <input type="text" name="cgpa" value="<?php echo $student['cgpa']; ?>" required>
        <input type="text" name="dues" value="<?php echo $student['dues']; ?>" required>
        <select name="status">
            <option value="Active" <?php if ($student['status'] == 'Active') echo 'selected'; ?>>Active</option>
            <option value="Inactive" <?php if ($student['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
        </select>
        <button type="submit">Update Student</button>
    </form>
</main>

<?php include "admin_footer.php"; ?>
</body>
</html>
