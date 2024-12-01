<!DOCTYPE html>
<?php
session_start();
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
                       
}else{
    $balanceString = "Please Log In";
    
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

        <link href="CSS/MainStyles.css"rel="stylesheet">
        <link href="CSS/FormStyle.css"rel="stylesheet">
        <link href="CSS/SideBar.css"rel="stylesheet">
        <link href="CSS/dropdown.css"rel="stylesheet">
        <link rel="stylesheet" href="./CSS/blackJack.css">

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
                        <a href="MainPage.php" id="homeButton"> <i class="bi bi-house-fill"></i> </a>
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
            <div class="container-fluid" id="mainpanel">
                <div class="row">
                    <div class="col-12">
                        <div id="game"><!-- the game board -->
                            <img id="deck" src="./imgs/cardBack.png"> <!-- the deck of cards -->
                            <!-- Divs to send drawn cards with DOM: (probably dont touch these or else js code might need updates)-->
                            <div id="dealerHand">
                                <div id="dealerCards"></div>
                            </div>
                            <div id="playerHand">
                                <div id="playerCards"></div>
                            </div>
                            
                            <!-- Controls: -->
                            <div id="startGameCTRLS">
                                <div class="slidecontainer">
                                    <p id="betAmountLBL">Bet Amount: $500!</p>
                                    <input type="range" min="5" max="10000" value="500" class="slider" id="betSlider" name="betSlider">
                                </div>
                                <button type="button" id="newGameBTN" class="gameBTN" class="gameBTN" onclick="newGame(document.getElementById('betSlider').value)">Start Game!</button><br><br>
                            </div>
                            <div id="gameCTRLS">
                                <button type="button" id="hitMeBTN" class="gameCTRL gameBTN" onclick="playerDraw()" disabled="true">Hit Me</button>
                                <button type="button" id="stayBTN" class="gameCTRL gameBTN" onclick="stay()" disabled="true">Stay</button>
                            </div>
                        </div><!-- end of game board -->
                    </div>
                </div>
            </div>


            <!--Overlay for the popups-->
            <div class="overlay"id='popupOverlay'>
            </div>

            <!--Popup For Login-->
            <div class="form-popup" id="loginform">
                <a href="javascript:void(0)" class="closebtn" onclick="closeLoginForm()">&times;</a>
                <form action="#"method="#">
                    <h1>Login</h1>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" id="email" required> <br> 
                    
                    <label for="pass"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" id="pass" required> <br> <br>

                    <input type="checkbox" value="true"> Keep me logged in? <br> 
                    <input type="submit"value="Login">

                    <div class="forgot">
                        <a href="https://letmegooglethat.com/?q=you+are+a+fucking+moron" target="blank">Forgot password?</a> <br> <br>
                        <a class="swapmenu" onclick="closeLoginForm() + openRegisterForm()">Don't have an account?</a>
                    </div>
                </form>
            </div>

            <!--Popup For Registration-->
            <div class="form-popup" id="registerform">
                <a href="javascript:void(0)" class="closebtn" onclick="closeRegisterForm()">&times;</a>
                <form action="userRegisterSQL.php" method="POST" onsubmit="return validateForm()">
                    <h1>Join Us Today!</h1>
                    
                    <p id="errorMessage">Test</p>
                    
                    <label for="fname"><b>First name</b></label>
                    <input type="text" placeholder="First name" name="fname" id="fname" required pattern="[a-zA-Z]+" oninvalid="setCustomValidity('Name must contain only letters')"> <br> 

                    <label for="lname"><b>Last name</b></label>
                    <input type="text" placeholder="Last name" name="lname" id="lname" required pattern="[a-zA-Z]+" oninvalid="setCustomValidity('Name must contain only letters')"> <br> 

                    <label for="email"><b>Email</b></label>
                    <input type="email" placeholder="Enter Email" name="email" id="email" required pattern='^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,63}$' oninvalid="setCustomValidity('Please enter a valid email')"> <br> 
                    
                    <label for="pass"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" id="pass" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"> <br> 

                    <label for="dateOfBirth"><b>Date of Birth</b></label> <br>
                    <input class="dateSelector" name="dayOfBirth" type="number"min="1"max="31"placeholder="1"> <!--Day Selector-->
                    <select name="month" id="month">
                        <option value="1">Jan</option>
                        <option value="2">Feb</option>
                        <option value="3">Mar</option>
                        <option value="4">Apr</option>
                        <option value="5">May</option>
                        <option value="6">Jun</option>
                        <option value="7">Jul</option>
                        <option value="8">Aug</option>
                        <option value="9">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>
                    </select> <!--Month Selector-->
                    <input class="dateSelector" name="yearOfBirth" type="number"min="1900"max="2025"placeholder="2024"> <!--Year Selector-->

                    <input type="submit"value="Register">

                    <div class="forgot">
                        <p>By clicking Register, you are agreeing to our <a href="#">Terms of Service</a>.</p> <br> 
                        <a class="swapmenu" onclick="closeRegisterForm() + openLoginForm()">Already have an account? Log in</a>
                    </div>
                </form>
            </div>
            
        <div class="form-popup" id="playAgain">
            <h1 id="gameResult">You Win!</h1>
            <p id="moneyChange">You have gained 10 billion dollars</p>
            <button onclick="location.href='MainPage.php'" class="menuButton">Go Home</button>
            <button onclick="location.href='blackJack.php'" class="menuButton">Play Again</button>
        </div>

        </main>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="blackJack.js"></script>

        <script src="MainPageFunctions.js"></script> <!-- Connect JavaScript-->
    </body>
</html>