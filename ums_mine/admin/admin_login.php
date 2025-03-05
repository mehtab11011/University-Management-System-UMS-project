<?php
include "../database/db.php"; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    $sql = "SELECT * FROM admin WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["admin"] = $username;
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
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
        <h2>🔐 Admin Login</h2>
        <?php if (isset($error)) { echo "<p class='error-msg'>$error</p>"; } ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Admin Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>

</body>
</html>
