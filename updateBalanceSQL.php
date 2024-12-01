<?php
session_start();

//connect to server and select database
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "finalProject");

$updateAmt = filter_input(INPUT_POST, 'updateAmt');
$gameResult = filter_input(INPUT_POST, 'gameResult');
$sql = "SELECT u.id, money FROM users u, user_accounts a WHERE u.id = a.id AND email = '".$_SESSION['email']."'";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
while ($info = mysqli_fetch_array($result)) {
	$userID = stripslashes($info['id']);
        $money = stripslashes($info['money']);
}
$money += $updateAmt;
$sql = "UPDATE user_accounts SET money = ".$money." WHERE id = ".$userID;
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
if($gameResult > 0){
    $sql = "UPDATE user_accounts SET gamesPlayed = gamesPlayed + 1 WHERE id = ".$userID;
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    if($gameResult == 3){
        $sql = "UPDATE user_accounts SET wins = wins + 1 WHERE id = ".$userID;
        $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
        $sql = "UPDATE user_accounts SET totalEarnings = (totalEarnings + ".$updateAmt.") WHERE id = ".$userID;
        $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    }else if($gameResult == 1){
        $sql = "UPDATE user_accounts SET losses = losses + 1 WHERE id = ".$userID;
        $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    }
}
$sql = "SELECT * FROM user_accounts WHERE id = ".$userID;
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
while ($info = mysqli_fetch_array($result)) {
	$_SESSION['wins'] = stripslashes($info['wins']);
        $_SESSION['losses'] = stripslashes($info['losses']);
        $_SESSION['totalEarnings'] = stripslashes($info['totalEarnings']);
        $_SESSION['gamesPlayed'] = stripslashes($info['gamesPlayed']);
}

$_SESSION['balance'] = $money;
?>