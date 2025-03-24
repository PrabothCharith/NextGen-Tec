<?php

$username = $_POST['username'];
$password = $_POST['password'];
$action = $_POST['action'];

try {
    $servername = "127.0.0.1";
    $usernamedb = "root";
    $passwordDb = "12345678";
    $database = "day14";
    $conn = new PDO("mysql:host=$servername;dbname=$database", $usernamedb, $passwordDb);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if ($action === 'register') {

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Check if the username already exists
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :un");
        $stmt->bindParam(':un', $username);
        $stmt->execute();
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($response) > 0) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Username already exists'
            ]);
            exit;
        }

        // Prepare the SQL statement
        // $stmt = $conn->prepare("INSERT INTO user (`username`,`password`) VALUES (:un,:pw)");
        $stmt = $conn->prepare("INSERT INTO user (`username`,`password`) VALUES (?,?)");

        // Set the parameters
        // $stmt->bindParam(':un', $username);
        // $stmt->bindParam(':pw', $hashedPassword);

        // Execute the statement
        // $response = $stmt->execute();
        $response = $stmt->execute([$username, $hashedPassword]);

        echo json_encode([
            'status' => 'success',
            'message' => 'User registered successfully',
            'response' => $response
        ]);
    }

    // else if ($action === 'login') {

    //     // // without prepared statement
    //     // $sql = "SELECT `password` FROM user WHERE username = '$username'";
    //     // $result = $conn->query($sql);
    //     // $response = $result->fetchAll(PDO::FETCH_ASSOC);

    //     // Prepare the SQL query
    //     $stmt = $conn->prepare("SELECT `password` FROM user WHERE username = :un");

    //     // Bind the parameter
    //     $stmt->bindParam(':un', $username);

    //     // Execute the query
    //     $stmt->execute();
    //     $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     $databasePassword = $response[0]['password'];

    //     // Check if multiple rows are returned
    //     if (count($response) === 1) {

    //         $passwordVerify = password_verify($password, $databasePassword);

    //         if ($passwordVerify) {
    //             echo json_encode([
    //                 'status' => 'success',
    //                 'message' => 'User logged in successfully',
    //             ]);
    //             exit;
    //         } else {
    //             echo json_encode([
    //                 'status' => 'error',
    //                 'message' => 'Invalid password'
    //             ]);
    //             exit;
    //         }

    //         exit;
    //     } else {
    //         echo json_encode([
    //             'status' => 'error',
    //             'message' => 'User not found'
    //         ]);
    //         exit;
    //     }

    //     echo json_encode([
    //         'status' => 'success',
    //         'message' => 'User logged in successfully',
    //         'response' => $response
    //     ]);
    // }

    // login short version

    else if ($action === 'login') {
        $stmt = $conn->prepare("SELECT `password` FROM user WHERE username = ?");
        // $stmt->bindParam(':un', $username);
        $stmt->execute([$username]);
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($response) === 1) {
            if (password_verify($password, $response[0]['password'])) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'User logged in successfully',
                ]);
                exit;
            }
        }

        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid username or password'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
