<?php
session_start();
//$updateAmt = $_POST['updateAmt'];

//connect to server and select database
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "finalProject");

$updateAmt = filter_input(INPUT_POST, 'updateAmt');
$sql = "UPDATE (SELECT * FROM users u, user_accounts a WHER u.id = a.id) temp SET money = money + ".$bet." WHERE email = ".$_SESSION['email'];
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

?>