<?php
    session_start();
    session_unset();
    session_destroy();
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <link href="CSS/Logout.css"rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <title>Waste of Money</title>
    </head>

    <body>

        <main id="main">
            
            <!-- The Main Panel which will hold most of the tiles for the games-->
             
            <!--Background with blur and gradient-->
            <div class="opacity"id="bgGrad">
            </div>
            <img src="Resources/Background(Main).png" class="Background" id="mainBackground">

            <!--Main Panel-->
            <div id="mainpanel">
                <!--Text-->
                <div id="logoutBox" class="col">
                    <h1>You have been successfully logged out</h1>
                    <h5> You will be redirected to the main page in 5 seconds.<h5> <br> <br>
                    <a href="MainPage.php"> If not please click here.</a>
                </div>
            </div>


            <div class="overlay"id='popupOverlay'>
            </div>

        </main>

        <footer>

        </footer>

        <script src="someFunctions.js"></script> <!-- Connect JavaScript-->
    </body>
</html>

