<?php
include "../database/db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $roll_number = trim($_POST['roll_number']);

    // Prevent SQL Injection
    $name = mysqli_real_escape_string($conn, $name);
    $roll_number = mysqli_real_escape_string($conn, $roll_number);

    // Check if student exists in admin_students table
    $sql = "SELECT * FROM admin_students WHERE name='$name' AND roll_number='$roll_number'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        $_SESSION["student_name"] = $student['name'];
        $_SESSION["student_roll"] = $student['roll_number'];

        // Redirect to Student Dashboard
        header("Location: student_dashboard.php");
        exit();
    } else {
        $error = "Invalid Name or Roll Number!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Orbitron', sans-serif;
        }

        body {
            background-color: #0a0a0a;
            color: #00ffcc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: rgba(0, 255, 204, 0.1);
            padding: 40px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 0 20px #00ffcc;
            width: 400px;
            max-width: 90%;
        }

        .login-container h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            background: #111;
            color: #00ffcc;
            border-bottom: 2px solid #00ffcc;
            font-size: 18px;
            text-align: center;
            outline: none;
            transition: 0.3s;
        }

        .login-container input:focus {
            border-bottom: 2px solid #008877;
        }

        .login-btn {
            background: #00ffcc;
            color: #111;
            border: none;
            padding: 12px;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
            width: 100%;
            font-size: 18px;
            margin-top: 10px;
        }

        .login-btn:hover {
            background: #008877;
        }

        .error-msg {
            color: red;
            margin-top: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Student Login</h2>
        <?php if (isset($error)) { echo "<p class='error-msg'>$error</p>"; } ?>
        <form action="" method="POST">
            <input type="text" name="name" placeholder="Enter Full Name" required>
            <input type="text" name="roll_number" placeholder="Enter Roll Number" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>

</body>
</html>
