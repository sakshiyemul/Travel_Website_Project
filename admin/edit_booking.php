<?php
$conn = new mysqli("localhost", "root", "", "web_project");

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Fetch booking details
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    // Fetch destination options
    $destinations = $conn->query("SELECT * FROM destinations");
}

if (isset($_POST['update'])) {
    $booking_id = $_POST['booking_id'];
    $dest_id = $_POST['dest_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $travel_date = $_POST['travel_date'];
    $travelers = $_POST['travelers'];

    $update = $conn->prepare("UPDATE bookings SET dest_id=?, full_name=?, email=?, phone=?, travel_date=?, travelers=? WHERE booking_id=?");
    $update->bind_param("issssii", $dest_id, $full_name, $email, $phone, $travel_date, $travelers, $booking_id);

    if ($update->execute()) {
        header("Location: manage_bookings.php?msg=Booking updated successfully!");
        exit();
    } else {
        echo "Update failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .navbar-brand {
            color: #0dcaf0;
            font-weight: bold;
        }

        .btn-back {
            background-color: #0dcaf0;
            color: #000;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 5px;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-back:hover {
            background-color: #0bb4d4;
            color: #000;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 15px;
            color: white;
        }

        label {
            color: #ccc;
        }

        .form-control, .form-select {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #ccc;
            color: white;
        }

        .form-control option, .form-select option {
            background-color: #333;
            color: white;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0dcaf0;
            box-shadow: none;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .btn-success {
            background-color: #198754;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand"><i class="fas fa-pen me-2"></i>Edit Booking</span>
    <a href="manage_bookings.php" class="btn btn-back btn-sm"><i class="fas fa-arrow-left me-1"></i>Back to Bookings</a>
</nav>

<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 600px;">
        <h4 class="text-center mb-4">✏️ Update Booking Details</h4>
        <form method="post">
            <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">

            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" value="<?= $booking['full_name'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $booking['email'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= $booking['phone'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Destination</label>
                <select name="dest_id" class="form-select" required>
                    <?php while ($dest = $destinations->fetch_assoc()) { ?>
                        <option value="<?= $dest['dest_id'] ?>" <?= ($dest['dest_id'] == $booking['dest_id']) ? 'selected' : '' ?>>
                            <?= $dest['dest_name'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Travel Date</label>
                <input type="date" name="travel_date" class="form-control" value="<?= $booking['travel_date'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Travelers</label>
                <input type="number" name="travelers" class="form-control" value="<?= $booking['travelers'] ?>" required>
            </div>

            <div class="text-center">
                <button type="submit" name="update" class="btn btn-success px-4">Update Booking</button>
                <a href="manage_bookings.php" class="btn btn-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
