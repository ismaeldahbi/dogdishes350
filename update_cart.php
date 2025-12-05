<?php
session_start();
include "db.php"; // === BEST PRACTICE: Moved include to the top ===

$id = intval($_GET['id']);
$action = $_GET['action'];

if (isset($_SESSION['cart'][$id])) {

    if ($action == "increase") {
        
        // === SECURITY FIX: Use prepared statement for stock check ===
        $product_id = $id;
        
        $stmt = $conn->prepare("SELECT stock FROM products WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        $stock = $row['stock'];
        $currentQty = $_SESSION['cart'][$id]['quantity'];

        if ($currentQty < $stock) {
            $_SESSION['cart'][$id]['quantity']++;
        }
    }

    if ($action == "decrease") {
        $_SESSION['cart'][$id]['quantity']--;
        if ($_SESSION['cart'][$id]['quantity'] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }

    if ($action == "remove") {
        unset($_SESSION['cart'][$id]);
    }
}

// Close DB connection
$conn->close();

header("Location: cart.php");
exit;
?>