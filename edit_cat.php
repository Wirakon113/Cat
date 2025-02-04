<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "its66040233113";
$password = "J3thD8O7";
$dbname = "its66040233113";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่ามีการส่ง id มาหรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ดึงข้อมูลที่จะแก้ไข
    $sql = "SELECT * FROM CatBreeds WHERE id = $id";
    $result = $conn->query($sql);
    $cat = $result->fetch_assoc();
}

// ตรวจสอบว่า submit form หรือไม่
if (isset($_POST['submit'])) {
    $name_th = $_POST['name_th'];
    $name_en = $_POST['name_en'];
    $description = $_POST['description'];
    $characteristics = $_POST['characteristics'];
    $care_instructions = $_POST['care_instructions'];
    $image_url = $_POST['image_url'];
    $is_visible = isset($_POST['is_visible']) ? 1 : 0;

    // อัปเดตข้อมูล
    $sql = "UPDATE CatBreeds SET 
            name_th = '$name_th', 
            name_en = '$name_en', 
            description = '$description', 
            characteristics = '$characteristics', 
            care_instructions = '$care_instructions', 
            image_url = '$image_url', 
            is_visible = '$is_visible' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('แก้ไขข้อมูลสำเร็จ!'); window.location.href = 'index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสายพันธุ์แมว</title>
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
            max-width: 700px;
            margin: 50px auto;
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
        .form-check-input {
            transform: scale(1.2);
            margin-right: 10px;
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

<!-- ฟอร์มแก้ไขข้อมูล -->
<div class="container form-container">
    <h2>แก้ไขข้อมูลสายพันธุ์แมว</h2>

    <form action="edit_cat.php?id=<?php echo $cat['id']; ?>" method="post">
        <div class="mb-3">
            <label for="name_th" class="form-label">ชื่อสายพันธุ์ (ไทย)</label>
            <input type="text" class="form-control" id="name_th" name="name_th" value="<?php echo $cat['name_th']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="name_en" class="form-label">ชื่อสายพันธุ์ (อังกฤษ)</label>
            <input type="text" class="form-control" id="name_en" name="name_en" value="<?php echo $cat['name_en']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">คำอธิบาย</label>
            <textarea class="form-control" id="description" name="description" rows="4" required><?php echo $cat['description']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="characteristics" class="form-label">ลักษณะทั่วไป</label>
            <textarea class="form-control" id="characteristics" name="characteristics" rows="3"><?php echo $cat['characteristics']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="care_instructions" class="form-label">คำแนะนำการเลี้ยงดู</label>
            <textarea class="form-control" id="care_instructions" name="care_instructions" rows="3"><?php echo $cat['care_instructions']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">URL ของรูปภาพ</label>
            <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo $cat['image_url']; ?>">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_visible" name="is_visible" <?php echo ($cat['is_visible'] == 1) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="is_visible">แสดงผล</label>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">แก้ไขข้อมูล</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
