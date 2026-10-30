<?php
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
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $message = trim($data['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        $response['message'] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Invalid email format.";
    } else {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $name, $email, $message); 

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Your message has been sent successfully!";
            } else {
                $response['message'] = "Error sending message: " . $stmt->error;
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
