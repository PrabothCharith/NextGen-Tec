<?php

$new_status = $_GET['status'];

$delete_id = $_GET['delete_id'];

$update_id = $_GET['update_id'];

if (isset($new_status) || isset($delete_id)) {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "12345678";
    $database = "user_management";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($new_status) && !isset($update_id)) {
        $conn->query("INSERT INTO `status` (`name`) VALUES ('$new_status')");
        if ($conn->error) {
            die("Error: " . $conn->error);
        }
    }

    if (isset($update_id) && isset($new_status)) {
        $conn->query("UPDATE `status` SET `name` = '$new_status' WHERE `id` = '$update_id'");
        if ($conn->error) {
            die("Error: " . $conn->error);
        }
    }

    if (isset($delete_id)) {
        $conn->query("DELETE FROM `status` WHERE `id` = '$delete_id'");
        if ($conn->error) {
            die("Error: " . $conn->error);
        }
    }

    $user_status = $conn->query('SELECT * FROM `status`');
    if ($user_status === false) {
        die("Error: " . $conn->error);
    }

?>

    <table>
        <tr>
            <th style="padding: 2px 10px; border: 1px solid black">ID</th>
            <th style="padding: 2px 10px; border: 1px solid black">Name</th>
        </tr>
        <?php
        while ($status = $user_status->fetch_assoc()) {
        ?>
            <tr>
                <td style="padding: 2px 10px; border: 1px solid black"><?php echo $status['id']; ?></td>
                <td style="padding: 2px 10px; border: 1px solid black"><?php echo $status['name']; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>

<?php

} else {
    echo "No data provided.";
}
?>