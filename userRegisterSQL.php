<?php
session_start();

//check for required fields from the form
if ((!filter_input(INPUT_POST, 'fname'))
        || (!filter_input(INPUT_POST, 'lname'))
        || (!filter_input(INPUT_POST, 'email')) 
        || (!filter_input(INPUT_POST, 'password'))
        || (!filter_input(INPUT_POST, 'dayOfBirth'))
        || (!filter_input(INPUT_POST, 'month'))
        || (!filter_input(INPUT_POST, 'yearOfBirth'))) {
        //unset session variables and destroy current session if it fails
        session_unset();
        session_destroy();
	header("Location: MainPage.php");
	exit;
}

//connect to server and select database
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "finalProject");

$fname = filter_input(INPUT_POST, 'fname');
$lname = filter_input(INPUT_POST, 'lname');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$dob = filter_input(INPUT_POST, 'dayOfBirth');
$mob = filter_input(INPUT_POST, 'month');
$yob = filter_input(INPUT_POST, 'yearOfBirth');
$sql = "INSERT INTO users VALUES(null, '".$fname."', '".$lname."', '".$email."', SHA1('".$password."'), 
        DATE('".$yob."-".$mob."-".$dob."'))";
      
//run the insert statement
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

//make sure it worked:
$sql = "SELECT id, email FROM users WHERE email = '".$email."'";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

//get the number of rows in the result set; should be 1 if a match
if (mysqli_num_rows($result) == 1) {
    //if it returns a row, it worked
    //insert a matching row into user_accounts
    while ($info = mysqli_fetch_array($result)) {
        //fetch the id we used from the select statement
        $id = stripslashes($info['id']);
    }
    $sql = "INSERT INTO user_accounts VALUES(".$id.", 50000, 0, 0, 0)";
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    header("Location: MainPage.php");
    exit;
	
} else {
    //it didnt work. maybe add functionality here to output a message or something (optional)
    header("Location: MainPage.php");
    exit;
}
?>

