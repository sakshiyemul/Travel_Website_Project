<?php include '../backend/connection.php'; ?>

<?php
$bookings = $conn->query("SELECT b.booking_id, d.dest_name, d.dest_location, b.full_name, b.email, b.phone, b.travel_date, b.travelers 
                          FROM bookings b
                          JOIN destinations d ON b.dest_id = d.dest_id");

$message = '';
if (!$bookings) {
    $message = "<div class='alert alert-danger'>Query Failed: " . $conn->error . "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings</title>
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

        .table {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }

        .table th {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .table td {
            background-color: transparent;
            color: white;
        }

        .btn-back {
            border: none;
            background-color: #0dcaf0;
            color: #000;
        }

        .btn-back:hover {
            background-color: #0bb4d4;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand"><i class="fas fa-book me-2"></i>Manage Bookings</span>
    <a href="admin_dashboard.html" class="btn btn-back btn-sm"><i class="fas fa-arrow-left me-1"></i>Back to Dashboard</a>
</nav>

<div class="container mt-5">
    <?php if (!empty($message)) echo $message; ?>

    <h4 class="mb-3 text-white">📋 All Bookings</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Destination</th>
                    <th>Location</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Travel Date</th>
                    <th>Travelers</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($bookings && $bookings->num_rows > 0): ?>
                    <?php while($row = $bookings->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['booking_id'] ?></td>
                        <td><?= $row['dest_name'] ?></td>
                        <td><?= $row['dest_location'] ?></td>
                        <td><?= $row['full_name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['travel_date'] ?></td>
                        <td><?= $row['travelers'] ?></td>
                        <td>
    <div class="d-flex gap-2">
        <a href="edit_booking.php?id=<?= $row['booking_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="delete_booking.php?id=<?= $row['booking_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
    </div>
</td>

                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="9" class="text-center text-white">No bookings found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
