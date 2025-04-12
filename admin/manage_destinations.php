<?php include '../backend/connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['dest_name'];
    $desc = $_POST['dest_description'];
    $location = $_POST['dest_location'];
    $price = $_POST['dest_price'];

    $image = $_FILES['dest_image']['name'];
    $temp_name = $_FILES['dest_image']['tmp_name'];
    $upload_folder = "uploads/";
    $image_path = $upload_folder . basename($image);

    if (move_uploaded_file($temp_name, $image_path)) {
        $sql = "INSERT INTO destinations (dest_name, dest_description, dest_image, dest_location, dest_price)
                VALUES ('$name', '$desc', '$image', '$location', '$price')";
        if ($conn->query($sql)) {
            $message = "<div class='alert alert-success'>Destination added successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>Image upload failed.</div>";
    }
}

$destinations = $conn->query("SELECT * FROM destinations");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Destinations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
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

        .btn-back {
            border: none;
            background-color: #0dcaf0;
            color: #000;
        }

        .btn-back:hover {
            background-color: #0bb4d4;
        }

        .card, .table-container {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 15px;
            color: white;
            padding: 20px;
        }

        label {
            color: #fff;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            box-shadow: none;
        }

        .table {
            background: rgba(255, 255, 255, 0.05);
        }

        .table th, .table td {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
        }

        .table th {
            background: rgba(255, 255, 255, 0.1);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        img {
            border-radius: 10px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand"><i class="fas fa-map-location-dot me-2"></i>Manage Destinations</span>
    <a href="admin_dashboard.html" class="btn btn-back btn-sm"><i class="fas fa-arrow-left me-1"></i>Back to Dashboard</a>
</nav>

<div class="container mt-5">
    <?php if (!empty($message)) echo $message; ?>

    <!-- Add Destination Form -->
    <div class="card mb-5 shadow">
        <h4 class="mb-3">Add Destination</h4>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Destination Name</label>
                    <input type="text" name="dest_name" class="form-control" placeholder="Enter destination name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="dest_location" class="form-control" placeholder="Enter location" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Price (₹)</label>
                    <input type="number" step="0.01" name="dest_price" class="form-control" placeholder="Enter price" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="dest_image" class="form-control" accept="image/*" required>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="dest_description" class="form-control" rows="3" placeholder="Enter description" required></textarea>
                </div>
            </div>
            <button name="submit" class="btn btn-info">Add Destination</button>
        </form>
    </div>

    <!-- Destination List -->
    <div class="table-container shadow mb-5">
        <h4 class="mb-3">📋 All Destinations</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $destinations->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['dest_id'] ?></td>
                        <td><?= $row['dest_name'] ?></td>
                        <td><?= $row['dest_location'] ?></td>
                        <td>₹<?= $row['dest_price'] ?></td>
                        <td><img src="uploads/<?= $row['dest_image'] ?>" width="100" height="60" style="object-fit: cover;"></td>
                        <td><?= $row['dest_description'] ?></td>
                        <td class="d-flex gap-2">
                        <a href="edit_destination.php?id=<?= $row['dest_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete_destination.php?id=<?= $row['dest_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this destination?');">Delete</a>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
