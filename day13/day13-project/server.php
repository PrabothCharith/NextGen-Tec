<?php

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'];
$email = $data['email'];
$user_password = $data['password'];
$type = $data['type'];

try {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "12345678";
    $database = "day13";
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($type == 'register') {
        $stmt = $conn->query("INSERT INTO user (name, email, password) VALUES ('$name', '$email','$user_password')");

        $conn = null;

        echo json_encode([
            'status' => 'success',
            'message' => 'User registered successfully',
            'output' => $stmt
        ]);
    } else if ($type == 'login') {
        $stmt = $conn->query("SELECT * FROM user WHERE email = '$email' AND password = '$user_password'");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($data) == 1) {
            echo json_encode([
                'status' => 'success',
                'message' => 'User logged in successfully',
                'output' => $data,
                'stmt' => $stmt
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid email or password',
                'output' => $data
            ]);
        }

        $conn = null;
    }
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
