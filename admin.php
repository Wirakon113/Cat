<?php
// เชื่อมต่อฐานข้อมูล (Connect to the database)
$servername = "localhost";
$username = "its66040233113";
$password = "J3thD8O7";
$dbname = "its66040233113";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่าคำค้นหาจากฟอร์ม (Get search value from form)
$search = isset($_POST['search']) ? $_POST['search'] : '';

// สร้าง SQL query สำหรับค้นหาข้อมูล (Create SQL query to search data)
$sql = "SELECT * FROM CatBreeds WHERE (name_th LIKE '%$search%' OR name_en LIKE '%$search%') AND is_visible = 1";
$result = $conn->query($sql);

$conn->close();
?>

<?php
session_start();

// ตรวจสอบว่ามีการเข้าสู่ระบบหรือยัง
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แสดงข้อมูลสายพันธุ์แมว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar a {
            color: white !important;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .search-box {
            margin-bottom: 20px;
        }
        .cat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .cat-card:hover {
            transform: scale(1.05);
        }
        .cat-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .cat-card a {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="admin.php">Home Admin</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="add_cat.php">Add Cat</a></li>
                <li class="nav-item"><a class="nav-link" href="visible.php">Edit</a></li>
                <li class="nav-item"><a class="nav-link" href="imageList.php" target="_blank">IMG</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">ออกจากระบบ</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2>สายพันธุ์แมวยอดนิยม</h2>
    
    <!-- ฟอร์มค้นหาข้อมูล -->
    <form method="POST" action="">
        <div class="input-group search-box">
            <input type="text" class="form-control" name="search" placeholder="ค้นหาสายพันธุ์แมว..." value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-custom" type="submit">ค้นหา</button>
        </div>
    </form>

    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4'>";
                echo "<div class='cat-card p-3'>";
                echo "<h3>" . $row['name_th'] . " (" . $row['name_en'] . ")</h3>";
                echo "<img src='" . $row['image_url'] . "' alt='Image'>";

                // คำอธิบายแบบย่อ
                echo "<p><strong>คำอธิบาย:</strong> " . $row['description'] . "</p>";

                // เพิ่ม Collapse สำหรับ "ลักษณะทั่วไป" และ "คำแนะนำการเลี้ยงดู"
                echo "<div id='collapseInfo" . $row['id'] . "' class='collapse'>";
                echo "<p><strong>ลักษณะทั่วไป:</strong> " . $row['characteristics'] . "</p>";
                echo "<p><strong>คำแนะนำการเลี้ยงดู:</strong> " . $row['care_instructions'] . "</p>";
                echo "</div>";

                // ปุ่มอ่านเพิ่มเติม
                echo "<button class='btn btn-sm btn-info' data-bs-toggle='collapse' data-bs-target='#collapseInfo" . $row['id'] . "'>";
                echo "อ่านเพิ่มเติม";
                echo "</button>";

                // ปุ่มแก้ไขและลบ
                echo "<a class='btn btn-warning btn-sm' href='edit_cat.php?id=" . $row['id'] . "'>แก้ไข</a>";
                echo "<a class='btn btn-danger btn-sm' href='delete_cat.php?id=" . $row['id'] . "'>ลบ</a>";

                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-center'>ไม่มีข้อมูลแสดง</p>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
