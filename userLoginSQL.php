<?php
session_start();

//check for required fields from the form
if ((!filter_input(INPUT_POST, 'email'))
        || (!filter_input(INPUT_POST, 'password'))) {
        //unset session variables and destroy current session if it fails
        session_unset();
        session_destroy();
	header("Location: MainPage.php");
	exit;
}

//connect to server and select database
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "finalProject");

$targetemail = filter_input(INPUT_POST, 'email');
$targetpasswd = filter_input(INPUT_POST, 'password');
$stayLoggedIn = filter_input(INPUT_POST, 'stayLoggedIn');

$sql = "SELECT fname, lname, email FROM users WHERE email = '".$targetemail.
        "' AND password = SHA1('".$targetpasswd."')";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

//get the number of rows in the result set; should be 1 if a match
if (mysqli_num_rows($result) == 1) { 
    //new SQL with join to get all their info:
    $sql = "SELECT * FROM users u, user_accounts a WHERE u.id = a.id AND email = '".$targetemail."'";
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    while ($info = mysqli_fetch_array($result)) {
		$fname = stripslashes($info['fname']);
		$lname = stripslashes($info['lname']);
                $email = stripslashes($info['email']);
                $balance = stripslashes($info['money']);
                $wins = stripslashes($info['wins']);
                $losses = stripslashes($info['losses']);
                $numGames = stripslashes($info['gamesPlayed']);
                $totalEarnings = stripslashes($info['totalEarnings']);
	}
        
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['email'] = $email;
        $_SESSION['balance'] = $balance;
        $_SESSION['wins'] = $wins;
        $_SESSION['losses'] = $losses;
        $_SESSION['numGames'] = $numGames;
        $_SESSION['totalEarnings'] = $totalEarnings;
        
	//set authorization cookie using curent Session ID
	setcookie("auth", session_id(), time()+60*30, "/", "", 0);
//        setcookie("fname", "$fname");
//        setcookie("lname", "$lname");
//        setcookie("email", strtolower("$email"));
//        setcookie("balance", "$balance");
//        setcookie("wins", "$wins");
//        setcookie("losses", "$losses");
//        setcookie("numGames", "$numGames");
        
        header("Location: MainPage.php");
        exit;
	
} else {
	//redirect back to login form if not authorized
        //unset session variables and destroy current session if not authorized
        session_unset();
        session_destroy();
	header("Location: MainPage.php");
	exit;
}
?>

