<?php
session_start();
require '../vendor/autoload.php';
require './utils/JwtHelper.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['email']) && isset($data['password']) && isset($_GET['t'])) {
    $type = $_GET['t'];
    $email = $data['email'];
    $password = $data['password'];

    $db_name = $_ENV['DB_NAME'];
    $db_user = $_ENV['DB_USER'];
    $db_pass = $_ENV['DB_PASSWORD'];
    $db_host = $_ENV['DB_HOST'];
    $db_port = $_ENV['DB_PORT'];

    try {
        $conn = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // check is register or login
        // r = register
        // l = login
        if ($type == 'r') {
            $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // check if user already exists
            if (count($user) == 0) {
                $stmt = $conn->prepare("INSERT INTO user (`email`, `password`) VALUES (:email, :password)");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));

                // check if user is registered
                if ($stmt->execute()) {

                    // set session
                    $_SESSION['user']['email'] = $email;

                    // send response to client side
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'User registered successfully'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'User registration failed'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'User already exists'
                ]);
            }
        } else if ($type == 'l') {
            $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $jwtHelper = new JwtHelper();

            // check if user exists
            if (count($user) == 1) {

                // check if password is correct
                if (password_verify($password, $user[0]['password'])) {
                    // set session
                    $_SESSION['user']['email'] = $email;

                    // jwt token data
                    $user_data = [
                        'email' => $email,
                        'id' => $user[0]['id']
                    ];

                    // generate jwt token
                    $token = $jwtHelper->generateToken($user_data);

                    // send response to client side
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'User logged in successfully',
                        'token' => $token,
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Invalid password'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'User not found'
                ]);
            }
        }

        // close connection
        $conn = null;
    } catch (PDOException $e) {
        // if database connection failed
        // send response to client side
        echo json_encode([
            'status' => 'error',
            'message' => 'Database connection failed: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid input'
    ]);
}
