<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: http://localhost/final-project/login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>

    <h1>User Profile</h1>

    <?php

    if (isset($_SESSION['user'])) {
    ?>
        <p>Email : <?php echo $_SESSION['user']['email']; ?></p>
    <?php
    }
    ?>

</body>

</html>