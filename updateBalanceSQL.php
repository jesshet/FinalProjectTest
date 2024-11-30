<?php
session_start();

//connect to server and select database
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "finalProject");

$updateAmt = filter_input(INPUT_POST, 'updateAmt');
$sql = "SELECT u.id, money FROM users u, user_accounts a WHERE u.id = a.id AND email = '".$_SESSION['email']."'";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
while ($info = mysqli_fetch_array($result)) {
	$userID = stripslashes($info['id']);
        $money = stripslashes($info['money']);
}
$money += $updateAmt;
$sql = "UPDATE user_accounts SET money = ".$money." WHERE id = ".$userID;
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
//$sql = "SELECT money FROM user_accounts WHERE id = ".$userID;
//$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
//while ($info = mysqli_fetch_array($result)) {
//	$balance = stripslashes($info['money']);
//}
$_SESSION['balance'] = $money;
?>