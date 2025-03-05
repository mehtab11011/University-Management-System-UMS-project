<?php
include "../database/db.php";
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $roll_number = $_POST['roll_number'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $cgpa = $_POST['cgpa'];
    $dues = $_POST['dues'];
    $status = $_POST['status'];
    $created_at = date("Y-m-d H:i:s");

    $query = "INSERT INTO admin_students (name, roll_number, email, phone, department, cgpa, dues, status, created_at) 
              VALUES ('$name', '$roll_number', '$email', '$phone', '$department', '$cgpa', '$dues', '$status', '$created_at')";
    
    if (mysqli_query($conn, $query)) {
        $message = "✅ Student added successfully!";
    } else {
        $message = "❌ Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/admin.css">
    <title>Add Student</title>
</head>
<body>

<?php include "admin_header.php"; ?>
<?php include "admin_sidebar.php"; ?>

<main class="dashboard">
    <h2>🆕 Add New Student</h2>
    <p class="message"><?php echo $message; ?></p>

    <form method="POST" class="admin-form">
        <input type="text" name="name" placeholder="Student Name" required>
        <input type="text" name="roll_number" placeholder="Roll Number" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <input type="text" name="department" placeholder="Department" required>
        <input type="text" name="cgpa" placeholder="cgpa" required>
        <input type="text" name="dues" placeholder="Pending Dues" required>
        <select name="status" required>
            <option value="" disabled selected>Select Status</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
        <button type="submit">➕ Add Student</button>
    </form>
</main>

<?php include "admin_footer.php"; ?>

</body>
</html>
