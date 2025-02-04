<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "its66040233113";
$password = "J3thD8O7";
$dbname =  "its66040233113";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกดูรูปภาพแมว</title>
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
        .gallery-container {
            max-width: 1000px;
            margin: 50px auto;
        }
        h2 {
            text-align: center;
            color: #ff5722;
            margin-bottom: 20px;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-title {
            text-align: center;
            font-weight: bold;
            color: #333;
            padding: 10px;
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
                    <a class="nav-link" href="imageList.php">Images</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- แสดงรูปภาพแมว -->
<div class="container gallery-container">
    <h2>เลือกดูรูปภาพแมว</h2>
    <div class="row g-4">
        <?php
        // รายการรูปภาพแมว
        $imageList = [
            "Bengal1.jpg", "Bengal2.jpg", "British Shorthair1.jpg", "British Shorthair2.jpg",
            "Exotic1.jpg", "Exotic2.jpg", "Exotic3.jpg", "Main Coon1.jpg", "Main Coon2.jpg",
            "Main Coon3.jpg", "Top 10 Cats_2.jpg", "americanShorthair1.jpg", "americanShorthair2.jpg",
            "americanShorthair3.jpg", "khaomanee1.jpg", "khaomanee2.jpg", "khaomanee3.jpg",
            "korat1.jpg", "korat2.jpg", "korat3.jpg", "persia1.jpg", "persia2.jpg", "persia3.jpg",
            "scotichfold1.jpg", "scotichfold2.jpg", "scotichfold3.jpg", "shorthair1.jpg", "siamese1.jpg",
            "siamese2.jpg", "siamese3.jpg"
        ];

        foreach ($imageList as $image) {
            $imageName = pathinfo($image, PATHINFO_FILENAME);
            $url = "https://hosting.udru.ac.th/{$username}/Cat/Cat/{$image}";

            echo "<div class='col-md-4 col-lg-3'>";
            echo "<div class='card'>";
            echo "<a href='{$url}' target='_blank'>";
            echo "<img src='{$url}' alt='{$imageName}'>";
            echo "<div class='card-title'>{$imageName}</div>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
