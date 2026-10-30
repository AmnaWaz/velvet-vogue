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

    error_log("Login Attempt - Username: " . $username);
    error_log("Login Attempt - Password (plain from JS): '" . $password . "'"); 

    if (empty($username) || empty($password)) {
        $response['message'] = "Username and password cannot be empty.";
    } else {
        $stmt = $conn->prepare("SELECT password FROM customers WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($hashed_password_from_db);
                $stmt->fetch();

                error_log("Login Attempt - Hashed Password from DB: " . $hashed_password_from_db);
                error_log("Login Attempt - Comparing: '" . $password . "' against '" . $hashed_password_from_db . "'"); 

                if (password_verify($password, $hashed_password_from_db)) {
                    $response['success'] = true;
                    $response['message'] = "Login successful!";
                    session_start();
                    $_SESSION['username'] = $username;
                } else {
                    $response['message'] = "Incorrect password.";
                }
            } else {
                $response['message'] = "Username not found.";
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
