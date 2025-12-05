<?php
session_start();
include "db.php";

$product_id = intval($_GET['id']);


$stmt = $conn->prepare("SELECT id, name, price, image_url, stock FROM products WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $product_id); 
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows == 1) {
    $product = $result->fetch_assoc();

    // Check stock
    if ($product['stock'] > 0) {

        // If cart doesn't exist, create it
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add or increase quantity
        if (isset($_SESSION['cart'][$product_id])) {
            // Check if increasing quantity exceeds stock (best practice)
            if ($_SESSION['cart'][$product_id]['quantity'] < $product['stock']) {
                $_SESSION['cart'][$product_id]['quantity']++;
            }
        } else {
            $_SESSION['cart'][$product_id] = [
                "id" => $product["id"],
                "name" => $product["name"],
                "price" => $product["price"],
                "image" => $product["image_url"],
                "quantity" => 1
            ];
        }
    }
}

// Close DB connection
$conn->close();

// === LOGIC FIX: Add ?added=true to trigger success alert ===
$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'products.php';

// Ensure we don't duplicate query parameters if HTTP_REFERER already has them
$separator = (strpos($redirect_url, '?') !== false) ? '&' : '?';
header("Location: " . $redirect_url . $separator . "added=true");

exit;
?>