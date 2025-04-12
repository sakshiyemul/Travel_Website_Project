<?php include '../backend/connection.php'; ?>
<?php
$search = $_GET['search'] ?? '';
$price_filter = $_GET['price_filter'] ?? '';

$query = "SELECT * FROM destinations WHERE 1";

if (!empty($search)) {
  $search = $conn->real_escape_string($search);
  $query .= " AND (dest_name LIKE '%$search%' OR dest_location LIKE '%$search%')";
}

if ($price_filter == 'under5k') {
  $query .= " AND dest_price < 5000";
} elseif ($price_filter == '5kto10k') {
  $query .= " AND dest_price BETWEEN 5000 AND 10000";
} elseif ($price_filter == 'above10k') {
  $query .= " AND dest_price > 10000";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Explore Destinations</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">

  <style>
    body {
      padding-top: 90px;
      background: #f0f0f5;
    }

    nav {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 10%;
      position: fixed;
      width: 100%;
      top: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(5px);
      z-index: 1000;
    }

    .logo {
      font-family: 'Pacifico', cursive;
      font-size: 33px;
      color: rgb(0, 206, 199);
      font-weight: bold;
    }

    nav ul {
      display: flex;
    }

    nav ul li {
      list-style: none;
      margin: 0 10px;
    }

    nav ul li a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }

    nav ul li a:hover {
      color: rgb(0, 206, 199);
      border-bottom: 2px solid rgb(0, 206, 199);
    }

    nav button {
      background-color: rgb(0, 206, 199);
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 25px;
      font-weight: bold;
    }

    .section-title {
      font-size: 36px;
      margin-bottom: 30px;
      color: #333;
    }

    .filter-bar {
      margin-bottom: 30px;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, opacity 0.3s;
      opacity: 0;
      animation: fadeIn 0.6s forwards;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }

    .card-img-top {
      height: 220px;
      object-fit: cover;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }

    .custom-btn {
      background-color: rgb(0, 206, 199);
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 30px;
      font-weight: bold;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .custom-btn:hover {
      background-color: #00bfb3;
      transform: scale(1.05);
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav>
  <h2 class="logo">Travelism</h2>
  <ul>
    <li><a href="index.html">Home</a></li>
    <li><a href="about.html">About</a></li>
    <li><a href="destinations.php">Destinations</a></li>
    <li><a href="contact.html">Contact</a></li>
  </ul>
  <a href="registration.html"><button>Register Here</button></a>
</nav>

<!-- Search + Filter -->
<section class="container py-5">
  <h2 class="text-center section-title">Top Destinations</h2>
  
  <form method="GET" class="row g-3 justify-content-center filter-bar">
    <div class="col-md-4">
      <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Search by name or location">
    </div>
    <div class="col-md-3">
      <select name="price_filter" class="form-select">
        <option value="">Filter by price</option>
        <option value="under5k" <?= $price_filter == 'under5k' ? 'selected' : '' ?>>Under ₹5,000</option>
        <option value="5kto10k" <?= $price_filter == '5kto10k' ? 'selected' : '' ?>>₹5,000 - ₹10,000</option>
        <option value="above10k" <?= $price_filter == 'above10k' ? 'selected' : '' ?>>Above ₹10,000</option>
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-info w-100 text-white">Apply</button>
    </div>
    <div class="col-md-2">
      <a href="destinations.php" class="btn btn-secondary w-100">Clear Filters</a>
    </div>
  </form>

  <!-- Cards Grid -->
  <div class="row gy-4 mt-3">
    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100">
            <img src="../admin/uploads/<?= $row['dest_image'] ?>" class="card-img-top" alt="<?= $row['dest_name'] ?>">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= $row['dest_name'] ?></h5>
              <p class="card-text"><?= $row['dest_description'] ?></p>
              <p><strong>📍 Location:</strong> <?= $row['dest_location'] ?></p>
              <p><strong>💸 Price:</strong> ₹<?= $row['dest_price'] ?></p>
              <a href="book_destination.php?dest_id=<?= $row['dest_id'] ?>" class="custom-btn mt-auto">Book Now</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12 text-center">
        <p class="text-muted">No destinations found. Try adjusting your search or filter.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

</body>
</html>
