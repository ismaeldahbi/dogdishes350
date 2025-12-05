<?php
session_start();
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Cart</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    />
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand fw-bold" href="index.php">BMCC DOG DISHES</a>
    <div class="navbar-nav ms-auto">
        <a class="nav-link" href="products.php">Products</a>
        <a class="nav-link active" href="cart.php">Cart</a>
    </div>
</nav>

<div class="container py-5">
    <h1 class="mb-4">Your Cart</h1>

    <?php
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
        echo "<p>Your cart is empty.</p>";
    } else {
        $total = 0;

        echo '<div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($_SESSION['cart'] as $id => $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;

            echo "
            <tr>
                <td>{$item['name']}</td>
                <td><img src='{$item['image']}' width='60'></td>
                <td>\$" . number_format($item['price'], 2) . "</td> <td>
                    <a href='update_cart.php?id=$id&action=decrease' class='btn btn-sm btn-warning'>-</a>
                    {$item['quantity']}
                    <a href='update_cart.php?id=$id&action=increase' class='btn btn-sm btn-success'>+</a>
                </td>
                <td>\$" . number_format($subtotal, 2) . "</td>
                <td>
                    <a href='update_cart.php?id=$id&action=remove' class='btn btn-sm btn-danger'>Remove</a>
                </td>
            </tr>";
        }

        echo "
                    </tbody>
                </table>
            </div>

            <h3 class='mt-4'>Grand Total: \$" . number_format($total, 2) . "</h3>";
    }
    echo '
    <div class="text-end mt-4">
        <a href="checkout.php" class="btn btn-success btn-lg">Checkout</a>
    </div>';
    
    // Best practice: Close DB connection
    $conn->close();
    ?>
</div>

</body>
</html>