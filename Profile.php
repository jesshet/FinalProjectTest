<!DOCTYPE html>
<?php
session_start();
$topRightDisplay = "";

if(isset($_SESSION['email'])){
    //check if a session is active (user logged in)
    //$balance = $_SESSION['balance'];
    $balanceString = "$ ".number_format((float)$_SESSION['balance'], 2);
    $welcomeString = "Welcome, ".$_SESSION['fname']; //This needs to be used somewhere still
    
    //if currently logged in set the display in the top right to be the fname and profile picture
    $topRightDisplay = "<p id=\"displayname\" onclick=\"openDropDown()\">".$_SESSION['fname']."</p>"
                        ."<div class=\"dropdown\"> "
                            ."<img src=\"Resources/profile-picture.png\"width=\"35px\" id=\"profilepic\" onclick=\"openDropDown()\">"
                            ."<div id=\"dropDownMenu\" class=\"dropdown-content\"> "
                                ."<a href=\"Profile.php\">Profile</a>"
                                ."<a href=\"Logout.php\">Log Out</a>"
                            ."</div>"
                        . "</div>";
    if($_SESSION['losses'] == 0){
        $ratio = $_SESSION['wins'] / 1;
    }else{
        $ratio = $_SESSION['wins'] / $_SESSION['losses'];
    }            
}else{
    $balanceString = "Please Log In";
    $ratio = 0.0;
    //if not logged in change the display in the top right to be the login/signup buttons
    $topRightDisplay = "<button type=\"button\" class=\"btn btn-outline-light mx-2\" onclick=\"closeRegisterForm() + openLoginForm()\">Log In</button>"
                       ."<button type=\"button\" class=\"btn btn-outline-light mx-2\" onclick=\"closeLoginForm() + openRegisterForm()\">Sign Up</button>";  
}

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <link href="CSS/MainStyle.css"rel="stylesheet">
        <link href="CSS/profile.css"rel="stylesheet">
        <link href="CSS/SideBar.css"rel="stylesheet">
        <link href="CSS/dropdown.css"rel="stylesheet">
        

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <title>Waste of Money</title>
    </head>

    <body>

        <main id="main">
            <!-- Header Panel with search bar and login/sign up buttons / currency tracking-->
            <div class="fixed-top mt-2 ml-4" id="headerpanel">
                <div class="row">
                     <!--Currency Tracking-->
                     <div class="col pt-1" id="currency">  
                        <p id="moneySymbol"> <i class="bi bi-cash-coin"></i> </p>
                        <p id="currentAmount"><?php echo $balanceString;?></p>
                    </div>
                    <div class="col" id="userhub">
                        <!-- Login/Signup -->
                        <?php echo $topRightDisplay; ?>  
                    </div>
                </div>
            </div>

            <!-- The Main Panel which will hold most of the tiles for the games-->
             
            <!--Background with blur and gradient-->
            <div class="opacity"id="bgGrad">
            </div>
            <img src="Resources/Background(Main).png" class="Background" id="mainBackground">

            <!--Main Panel-->
            <div class="container-fluid mt-4" id="mainpanel">
                <div class="row">
                    <div class="col-2"id="leftPanel">
                        <div id="picGroup">
                            <img src="Resources/profile-picture.png"width="250px"id="profilePicture">
                            <h1 id="Username">Default User</h1>
                        </div>
                        <button class="profileButton"> Change Profile Picture </button>
                        <button class="profileButton"> Change Password </button>
                        <button class="profileButton"> Add Funds </button>
                    </div>

                    <div class="col g-0"id="rightPanel">
                        <!--Holds the win loss info-->
                        <div class="container-fluid" id="GWL">
                            <div class="row">
                                <div class="col">
                                    <h2 class="titles">Games</h2>
                                    <p class="gameResults" id="totalGames"><?php echo $_SESSION['gamesPlayed'];?></p>
                                </div>
                                <div class="col">
                                    <h2 class="titles">Wins</h2>
                                    <p class="gameResults" id="totalWins"><?php echo $_SESSION['wins'];?></p>
                                </div>
                                <div class="col">
                                    <h2 class="titles">Losses</h2>
                                    <p class="gameResults" id="totalLosses"><?php echo $_SESSION['losses'];?></p>
                                </div>
                            </div>
                        </div>

                        <!--Big ol block of user information-->
                        <div class="container-fluid" id="profileInformation">
                            <div class="row">
                                <div class="col">
                                    <h3 id="profileTitle">Profile Information</h3>
                                    <div class="break"><p></p></div>

                                    <div class="container-fluid profileDataEven">
                                        <div class="row">
                                            <div class="col text-start leftText">
                                                <p>Username:</p>
                                            </div>
                                            <div class="col text-end rightText">
                                                <p><?php echo $_SESSION['email'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid profileDataOdd">
                                        <div class="row">
                                            <div class="col text-start leftText">
                                                <p>Password:</p>
                                            </div>
                                            <div class="col text-end rightText">
                                                <p>************</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid profileDataEven">
                                        <div class="row">
                                            <div class="col text-start leftText">
                                                <p>Email:</p>
                                            </div>
                                            <div class="col text-end rightText">
                                                <p><?php echo $_SESSION['email'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid profileDataOdd">
                                        <div class="row">
                                            <div class="col text-start leftText">
                                                <p>First Name:</p>
                                            </div>
                                            <div class="col text-end rightText">
                                                <p><?php echo $_SESSION['fname'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid profileDataEven">
                                        <div class="row">
                                            <div class="col text-start leftText">
                                                <p>Last Name:</p>
                                            </div>
                                            <div class="col text-end rightText">
                                                <p><?php echo $_SESSION['lname'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid profileDataOdd">
                                        <div class="row">
                                            <div class="col text-start leftText">
                                                <p>CurrentMoney:</p>
                                            </div>
                                            <div class="col text-end rightText">
                                                <p><?php echo $_SESSION['balance'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid profileDataEven">
                                        <div class="row">
                                            <div class="col text-start leftText">
                                                <p>Total Earnings:</p>
                                            </div>
                                            <div class="col text-end rightText">
                                                <p><?php echo $_SESSION['totalEarnings'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid profileDataOdd">
                                        <div class="row">
                                            <div class="col text-start leftText">
                                                <p>Win Loss Ratio:</p>
                                            </div>
                                            <div class="col text-end rightText">
                                                <p id='ratio'><?php echo $ratio;?></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        <footer>

        </footer>

        <script src="MainPageFunctions.js"></script> <!-- Connect JavaScript-->
    </body>
</html>

