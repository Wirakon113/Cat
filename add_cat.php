<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "its66040233113";
$password = "J3thD8O7";
$dbname =  "its66040233113";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name_th = $_POST['name_th'];
    $name_en = $_POST['name_en'];
    $description = $_POST['description'];
    $characteristics = $_POST['characteristics'];
    $care_instructions = $_POST['care_instructions'];
    $image_url = $_POST['image_url'];
    $is_visible = isset($_POST['is_visible']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO CatBreeds (name_th, name_en, description, characteristics, care_instructions, image_url, is_visible) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $name_th, $name_en, $description, $characteristics, $care_instructions, $image_url, $is_visible);

    if ($stmt->execute()) {
        echo "<script>alert('เพิ่มข้อมูลสำเร็จ!'); window.location.href = 'admin.php';</script>";
    } else {
        echo "ข้อผิดพลาด: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลสายพันธุ์แมว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #ff9800;
        }
        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: bold;
        }
        .form-container {
            max-width: 600px;
            background: white;
            padding: 30px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #ff5722;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-submit {
            background-color: #ff9800;
            color: white;
            width: 100%;
            padding: 10px;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
        }
        .btn-submit:hover {
            background-color: #e68900;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">Cat Breeds</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Home Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_cat.php">Add Cat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="imageList.php" target="_blank">Images</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ฟอร์มเพิ่มข้อมูล -->
<div class="container form-container">
    <h2>เพิ่มข้อมูลสายพันธุ์แมว</h2>

    <form action="add_cat.php" method="post">
        <div class="mb-3">
            <label for="name_th" class="form-label">ชื่อสายพันธุ์ (ไทย):</label>
            <input type="text" class="form-control" id="name_th" name="name_th" required>
        </div>

        <div class="mb-3">
            <label for="name_en" class="form-label">ชื่อสายพันธุ์ (อังกฤษ):</label>
            <input type="text" class="form-control" id="name_en" name="name_en" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">คำอธิบาย:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="characteristics" class="form-label">ลักษณะทั่วไป:</label>
            <textarea class="form-control" id="characteristics" name="characteristics" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="care_instructions" class="form-label">คำแนะนำการเลี้ยงดู:</label>
            <textarea class="form-control" id="care_instructions" name="care_instructions" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">URL ของรูปภาพ:</label>
            <input type="text" class="form-control" id="image_url" name="image_url">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_visible" name="is_visible" checked>
            <label class="form-check-label" for="is_visible">แสดงผลในเว็บไซต์</label>
        </div>

        <button type="submit" name="submit" class="btn-submit">เพิ่มข้อมูล</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
