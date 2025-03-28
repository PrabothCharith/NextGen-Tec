<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['email']) && isset($data['password']) && isset($_GET['t'])) {
    $type = $_GET['t'];
    $email = $data['email'];
    $password = $data['password'];

    $db_name = "final_project";
    $db_user = "root";
    $db_pass = "12345678";
    $db_host = "127.0.0.1";
    $db_port = "3306";

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

            // check if user exists
            if (count($user) == 1) {

                // check if password is correct
                if (password_verify($password, $user[0]['password'])) {
                    // set session
                    $_SESSION['user']['email'] = $email;

                    // send response to client side
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'User logged in successfully'
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
