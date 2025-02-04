<?php
session_start();

// ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // เช็ค username และ password
    if ($username === "oem2547" && $password === "oem2547") {
        $_SESSION["admin_logged_in"] = true; // ตั้งค่าสถานะ login
        header("Location: admin.php"); // ไปที่หน้า admin
        exit();
    } else {
        $error = "❌ Username หรือ Password ไม่ถูกต้อง!";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #ff9800;
        }
        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #ff5722;
            margin-bottom: 20px;
        }
        .btn-primary {
            width: 100%;
            background-color: #ff9800;
            border: none;
        }
        .btn-primary:hover {
            background-color: #e68900;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">Cat Breeds Admin</a>
    </div>
</nav>

<!-- ฟอร์มเข้าสู่ระบบ -->
<div class="container">
    <div class="login-container">
        <h2>เข้าสู่ระบบ Admin</h2>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">👤 Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">🔑 Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
