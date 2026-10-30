<?php
session_start(); 
require_once 'includes/db_connect.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$response = ['success' => false, 'message' => 'An unknown error occurred.', 'cart_items' => []];

if (!isset($_SESSION['username'])) {
    $response['message'] = "User not logged in.";
    echo json_encode($response);
    exit();
}

$username = $_SESSION['username'];

try {

    $stmt = $conn->prepare("SELECT product_name, price, quantity FROM cart_items WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $cart_items = [];
        while ($row = $result->fetch_assoc()) {
            $cart_items[] = $row;
        }

        $response['success'] = true;
        $response['message'] = "Cart items fetched successfully.";
        $response['cart_items'] = $cart_items;
        $stmt->close();
    } else {
        $response['message'] = "Database statement preparation failed: " . $conn->error;
    }
} catch (Exception $e) {
    $response['message'] = "Error fetching cart items: " . $e->getMessage();
}

$conn->close();
echo json_encode($response);
?>
