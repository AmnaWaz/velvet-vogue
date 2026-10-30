<?php
session_start(); 
require_once 'includes/db_connect.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$response = ['success' => false, 'message' => 'An unknown error occurred.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['username'])) {
        $response['message'] = "You must be logged in to checkout.";
        echo json_encode($response);
        exit();
    }

    $username = $_SESSION['username']; 

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $total_amount = $data['total_amount'] ?? 0.00; 

    if (!is_numeric($total_amount) || $total_amount < 0) {
        $response['message'] = "Invalid total amount provided.";
        echo json_encode($response);
        exit();
    }

    try {
        $stmt = $conn->prepare("DELETE FROM cart_items WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Checkout successful! Your total amount to be paid is: $" . number_format($total_amount, 2);
            } else {
                $response['message'] = "Error clearing cart: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $response['message'] = "Database statement preparation failed: " . $conn->error;
        }
    } catch (Exception $e) {
        $response['message'] = "Error during checkout: " . $e->getMessage();
    }
} else {
    $response['message'] = "Invalid request method.";
}

$conn->close();
echo json_encode($response);
?>
