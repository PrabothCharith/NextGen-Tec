<?php

// GET request
// $v1 = $_GET['v1'];
// $v2 = $_GET['v2'];

// POST request
// $v1 = $_POST['v1'];
// $v2 = $_POST['v2'];

// POST request with JSON
$data = json_decode(file_get_contents('php://input', true));
$v1 = $data->v1;
$v2 = $data->v2;

// echo $v1 + $v2;

// Response with JSON
echo json_encode(['v1' => $v1, 'v2' => $v2, 'result' => $v1 + $v2]);
