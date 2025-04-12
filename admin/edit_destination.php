<?php
include '../backend/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $destination = $conn->query("SELECT * FROM destinations WHERE dest_id=$id")->fetch_assoc();

    if (isset($_POST['update'])) {
        $name = $_POST['dest_name'];
        $desc = $_POST['dest_description'];
        $location = $_POST['dest_location'];
        $price = $_POST['dest_price'];

        $image = $destination['dest_image']; // Default image
        if (!empty($_FILES['dest_image']['name'])) {
            $image = $_FILES['dest_image']['name'];
            $temp_name = $_FILES['dest_image']['tmp_name'];
            $upload_folder = "uploads/";
            move_uploaded_file($temp_name, $upload_folder . basename($image));
        }

        $sql = "UPDATE destinations SET 
                dest_name='$name',
                dest_description='$desc',
                dest_location='$location',
                dest_price='$price',
                dest_image='$image'
                WHERE dest_id=$id";

        if ($conn->query($sql)) {
            echo "<script>
                    alert('Destination updated successfully!');
                    window.location.href='manage_destinations.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error updating destination: " . $conn->error . "');
                  </script>";
        }
    }
} else {
    echo "<script>
            alert('Invalid request!');
            window.location.href='manage_destinations.php';
          </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Destination</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e') no-repeat center center fixed;
            background-size: cover;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .navbar-brand {
            color: #0dcaf0;
            font-weight: bold;
        }

        .card {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 20px;
            color: white;
        }

        label {
            color: white;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            box-shadow: none;
        }

        .btn-back {
            border: none;
            background-color: #0dcaf0;
            color: #000;
        }

        .btn-back:hover {
            background-color: #0bb4d4;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand"><i class="fas fa-map-location-dot me-2"></i>Edit Destination</span>
    <a href="manage_destinations.php" class="btn btn-back btn-sm"><i class="fas fa-arrow-left me-1"></i>Back to List</a>
</nav>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h4 class="mb-3">Update Destination Details</h4>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Destination Name</label>
                    <input type="text" name="dest_name" class="form-control" value="<?= $destination['dest_name'] ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="dest_location" class="form-control" value="<?= $destination['dest_location'] ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Price (₹)</label>
                    <input type="number" name="dest_price" step="0.01" class="form-control" value="<?= $destination['dest_price'] ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Upload New Image</label>
                    <input type="file" name="dest_image" class="form-control" accept="image/*">
                    <small class="text-light mt-1">Current: <?= $destination['dest_image'] ?></small>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="dest_description" class="form-control" rows="4" required><?= $destination['dest_description'] ?></textarea>
                </div>
            </div>
            <button name="update" class="btn btn-info">Update Destination</button>
        </form>
    </div>
</div>

</body>
</html>
