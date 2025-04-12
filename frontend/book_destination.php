
<?php
session_start();

// If user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

include '../backend/connection.php';

if (isset($_GET['dest_id'])) {
    $dest_id = $_GET['dest_id'];
    $query = "SELECT * FROM destinations WHERE dest_id = $dest_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $destination = mysqli_fetch_assoc($result);
    } else {
        echo "Destination not found!";
        exit;
    }
} else {
    echo "Invalid request!";
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Now - <?= $destination['dest_name'] ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      padding: 20px;
      background-color: #f2f2f2;
    }

    .booking-container {
      max-width: 800px;
      margin: 0 auto;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .destination-details {
      text-align: center;
      margin-bottom: 30px;
    }

    .destination-details img {
      width: 60%;
      max-height: 200px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 15px;
    }

    .destination-details h2 {
      color: #00cec9;
      margin-bottom: 10px;
    }

    .destination-details p {
      color: #555;
      font-size: 15px;
      margin: 5px 0;
    }

    h3 {
      text-align: center;
      margin-bottom: 20px;
      color: #2d3436;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input, select {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
    }

    button {
      padding: 12px;
      background-color: #00cec9;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #00b3ad;
    }
  </style>
</head>
<body>

  <div class="booking-container">
    <div class="destination-details">
      <img src="../admin/uploads/<?= $destination['dest_image'] ?>" alt="<?= $destination['dest_name'] ?>">
      <h2><?= $destination['dest_name'] ?></h2>
      <p><strong>Description:</strong> <?= $destination['dest_description'] ?></p>
      <p><strong>Location:</strong> <?= $destination['dest_location'] ?></p>
      <p><strong>Price:</strong> ₹<?= $destination['dest_price'] ?></p>
    </div>

    <h3>Book Your Trip</h3>

    <form action="submit_booking.php" method="POST">
      <input type="hidden" name="dest_id" value="<?= $destination['dest_id'] ?>">
      <input type="text" name="full_name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <input type="date" name="travel_date" required>
      <select name="travelers" required>
        <option value="">Number of Travelers</option>
        <?php for ($i = 1; $i <= 10; $i++) echo "<option value='$i'>$i</option>"; ?>
      </select>
      <button type="submit" name="submit">Confirm Booking</button>
    </form>
  </div>

</body>
</html>
