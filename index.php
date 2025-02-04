<?php
session_start();

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "its66040233113";
$password = "J3thD8O7";
$dbname = "its66040233113";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่าคำค้นหาจากฟอร์ม
$search = isset($_POST['search']) ? $_POST['search'] : '';

$sql = "SELECT * FROM CatBreeds WHERE (name_th LIKE '%$search%' OR name_en LIKE '%$search%') AND is_visible = 1";
$result = $conn->query($sql);

$conn->close();
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
        .container {
            margin-top: 50px;
        }
        .search-box {
            max-width: 500px;
            margin: 0 auto;
        }
        .cat-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .cat-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .cat-card h3 {
            margin-top: 10px;
            font-size: 1.5rem;
            color: #ff5722;
        }
        .cat-card p {
            font-size: 1rem;
            color: #555;
        }
        .read-more {
            color: #ff9800;
            cursor: pointer;
            font-weight: bold;
        }
        .hidden-content {
            display: none;
        }
        .no-data {
            text-align: center;
            font-size: 1.2rem;
            color: #888;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">Cat Breeds</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ค้นหา -->
<div class="container">
    <h2 class="text-center my-4">สายพันธุ์แมวยอดนิยม</h2>
    <form method="POST" action="" class="mb-4">
        <div class="input-group search-box">
            <input type="text" class="form-control" name="search" placeholder="ค้นหาสายพันธุ์แมว..." value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-warning" type="submit">ค้นหา</button>
        </div>
    </form>

    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-lg-4 col-md-6'>";
                echo "<div class='cat-card'>";
                echo "<img src='" . $row['image_url'] . "' alt='Image'>";
                echo "<h3>" . $row['name_th'] . " (" . $row['name_en'] . ")</h3>";

                // คำอธิบาย
                echo "<p><strong>คำอธิบาย:</strong> ";
                echo "<span class='short-text'>" . mb_substr($row['description'], 0, 100, "UTF-8") . "...</span>";
                echo "<span class='hidden-content full-text' style='display: none;'>" . $row['description'] . "</span>";
                echo "<span class='read-more' onclick='toggleText(this)'> อ่านเพิ่มเติม</span>";
                echo "</p>";

                // ลักษณะทั่วไป
                echo "<p><strong>ลักษณะทั่วไป:</strong> ";
                echo "<span class='short-text'>" . mb_substr($row['characteristics'], 0, 100, "UTF-8") . "...</span>";
                echo "<span class='hidden-content full-text' style='display: none;'>" . $row['characteristics'] . "</span>";
                echo "<span class='read-more' onclick='toggleText(this)'> อ่านเพิ่มเติม</span>";
                echo "</p>";

                // คำแนะนำการเลี้ยงดู
                echo "<p><strong>คำแนะนำการเลี้ยงดู:</strong> ";
                echo "<span class='short-text'>" . mb_substr($row['care_instructions'], 0, 100, "UTF-8") . "...</span>";
                echo "<span class='hidden-content full-text' style='display: none;'>" . $row['care_instructions'] . "</span>";
                echo "<span class='read-more' onclick='toggleText(this)'> อ่านเพิ่มเติม</span>";
                echo "</p>";

                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='no-data'>ไม่มีข้อมูลแสดง</p>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleText(element) {
    let shortText = element.previousElementSibling.previousElementSibling;
    let fullText = element.previousElementSibling;

    if (fullText.style.display === "none") {
        shortText.style.display = "none";
        fullText.style.display = "inline";
        element.textContent = " ซ่อน";
    } else {
        shortText.style.display = "inline";
        fullText.style.display = "none";
        element.textContent = " อ่านเพิ่มเติม";
    }
}
</script>

</body>
</html>
