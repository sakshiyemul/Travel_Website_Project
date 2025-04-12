<?php include 'connection.php'; ?>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['dest_name'];
    $desc = $_POST['dest_description'];
    $location = $_POST['dest_location'];
    $price = $_POST['dest_price'];

    // Handle image upload
    $image = $_FILES['dest_image']['name'];
    $temp_name = $_FILES['dest_image']['tmp_name'];
    $upload_folder = "uploads/";
    $image_path = $upload_folder . basename($image);

    // Move image to uploads folder
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Destination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">🗺️ Add New Destination</h2>

    <?php if (!empty($message)) echo $message; ?>

    <form method="POST" enctype="multipart/form-data" class="card p-4 shadow">
        <div class="mb-3">
            <label class="form-label">Destination Name</label>
            <input type="text" name="dest_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="dest_description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="dest_location" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price (₹)</label>
            <input type="number" step="0.01" name="dest_price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Upload Image</label>
            <input type="file" name="dest_image" class="form-control" accept="image/*" required>
        </div>
        <button name="submit" class="btn btn-primary">Add Destination</button>
    </form>
</div>
</body>
</html>
