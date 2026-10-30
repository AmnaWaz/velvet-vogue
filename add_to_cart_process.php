<?php
session_start(); 
require_once 'includes/db_connect.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$response = ['success' => false, 'message' => 'An unknown error occurred.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['username'])) {
        $response['message'] = "You must be logged in to add items to the cart.";
        echo json_encode($response);
        exit();
    }

    $username = $_SESSION['username']; 

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $product_name = $data['product'] ?? '';
    $price = $data['price'] ?? 0.00;
    $quantity = $data['quantity'] ?? 1; 

    if (empty($product_name) || !is_numeric($price) || $price <= 0) {
        $response['message'] = "Invalid product data.";
    } else {

        $stmt = $conn->prepare("INSERT INTO cart_items (username, product_name, price, quantity) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssdi", $username, $product_name, $price, $quantity); 

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Item added to cart successfully!";
            } else {
                $response['message'] = "Error adding item to cart: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $response['message'] = "Database statement preparation failed: " . $conn->error;
        }
    }
} else {
    $response['message'] = "Invalid request method.";
}

$conn->close();
echo json_encode($response);
?>
