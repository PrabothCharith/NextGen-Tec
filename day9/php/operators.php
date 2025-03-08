<?php
$x = 5;
$y = 2;
$z = '5';

echo 'x + y = ' . ($x + $y);
echo '<br>';
echo 'x - y = ' . ($x - $y);
echo '<br>';
echo 'x * y = ' . ($x * $y);
echo '<br>';
echo 'x / y = ' . ($x / $y);
echo '<br>';
echo 'x % y = ' . ($x % $y);
echo '<br>';

echo 'x + z = ' . $x . '' . $z;

echo '<br>';

// get values using GET request

$customValue1 = 1;
$customValue2 = 2;

if (isset($_GET['v1']) && isset($_GET['v2'])) {
    $customValue1 = $_GET['v1'];
    $customValue2 = $_GET['v2'];
}

echo 'customValue1 = ' . $customValue1;
echo '<br>';
echo 'customValue2 = ' . $customValue2;
echo '<br>';
echo 'customValue1 + customValue2 = ' . ($customValue1 + $customValue2);

// http://localhost:8000/operators.php?v1=4&v2=6