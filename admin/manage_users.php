<?php
$conn = new mysqli("localhost", "root", "", "web_project");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch registered users
$users = $conn->query("SELECT * FROM register");

if (!$users) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
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

        .table-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.4);
            color: white;
        }

        .table {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .table th, .table td {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand"><i class="fas fa-users me-2"></i>Manage Users</span>
    <a href="admin_dashboard.html" class="btn btn-back btn-sm"><i class="fas fa-arrow-left me-1"></i>Back to Dashboard</a>
</nav>

<div class="container mt-5 table-container">
    <h4 class="mb-4 text-center">👥 Registered Users</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users->num_rows > 0): ?>
                    <?php while($user = $users->fetch_assoc()): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['fullname'] ?></td>
                            <td><?= $user['email'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center text-light">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
