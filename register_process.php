<?php
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
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    if (empty($username) || empty($password)) {
        $response['message'] = "Username and password cannot be empty.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO customers (username, password) VALUES (?, ?)"); 
        if ($stmt) {
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Registration successful!";
            } else {
                if ($conn->errno == 1062) { 
                    $response['message'] = "Username already exists. Please choose a different one.";
                } else {
                    $response['message'] = "Error registering user: " . $stmt->error;
                }
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
