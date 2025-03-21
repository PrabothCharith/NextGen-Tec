<?php
$servername = "127.0.0.1";
$username = "root";
$password = "12345678";
$database = "user_management";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_status = $conn->query('SELECT * FROM `status`');
if ($user_status === false) {
    die("Error: " . $conn->error);
}

?>

<h1>User Management</h1>

<p>user status</p>
<?php
// echo $user_status->fetch_assoc()['name'];
// echo "<br>";
// echo $user_status->fetch_assoc()['name'];
// echo "<br>";
// echo $user_status->fetch_assoc()['name'];
// echo "<br>";
// echo $user_status->fetch_assoc()['name'];
// echo "<br>";
// echo $user_status->fetch_assoc()['name'];
// echo "<br>";

// while ($state = $user_status->fetch_assoc()) {
//     echo $state['name'];
//     echo "<br>";
// }
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