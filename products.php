<?php
session_start();
include "db.php";

// Check if user is logged in
$is_logged_in = isset($_SESSION['user_id']);
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Products - BMCC Dog Dishes</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    />
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        
        body {
            background-color: #f5e7b5;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand fw-bold" href="index.php">BMCC DOG DISHES</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
        <div class="navbar-nav ms-auto">
            <a class="nav-link active" href="products.php">Products</a>
            
            <?php if ($is_logged_in): ?>
                <span class="nav-link text-light">Welcome, <?php echo htmlspecialchars($username); ?>!</span>
                <a class="nav-link" href="logout.php">Logout</a>
            <?php else: ?>
                <a class="nav-link" href="login.php">Login</a>
                <a class="nav-link" href="register.php">Register</a>
            <?php endif; ?>
            
            <a class="nav-link" href="cart.php">
                Cart
                <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                    <span class="badge bg-danger"><?php echo count($_SESSION['cart']); ?></span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h1 class="mb-4">Our Products</h1>

    <?php if (isset($_GET['added'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✓ Product added to cart!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row d-flex flex-wrap"> 
        <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $inStock = $row["stock"] > 0;

                $badge = $inStock 
                    ? '<span class="badge bg-success">In Stock (' . $row["stock"] . ')</span>' 
                    : '<span class="badge bg-danger">Sold Out</span>';

                $button = $inStock
                    ? '<a href="add_to_cart.php?id=' . $row["id"] . '" class="btn btn-primary w-100 mt-2 mt-auto">Add to Cart</a>'
                    : '<button class="btn btn-secondary w-100 mt-2 mt-auto" disabled>Sold Out</button>';

                echo '
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card h-100 shadow-sm">
                        <img src="' . htmlspecialchars($row["image_url"]) . '" class="card-img-top" alt="product">

                        <div class="card-body py-2 d-flex flex-column"> 
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">' . htmlspecialchars($row["name"]) . '</h5>
                                ' . $badge . '
                            </div>

                            <p class="card-text mt-2 mb-2">' . htmlspecialchars($row["description"]) . '</p>
                            <p class="fw-bold mb-2 text-success">$' . number_format($row["price"], 2) . '</p>

                            ' . $button . '
                        </div>
                    </div>
                </div>
                ';
            }
            
        } else {
            echo "<p>No products available.</p>";
        }

        $conn->close();
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>