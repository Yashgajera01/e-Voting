<?php  
session_start();

include 'partial/_dbconnect.php';
$select = mysqli_query($conn,"select * from admin");
$data = mysqli_fetch_array($select);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script defer src="js/navbar.js"></script>   
    <title>e-Voting</title>
</head>

<body>

    <section class="backgroud main-Section">

        <nav class="navbar ">

            <ul class="nav-list">
                <div class="logo"><img src="image/logo.jpg" alt="logo"></div>
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="php/login.php">Login</a></li>
                <li><a href="php/signup.php">Register</a></li>
            </ul>
    
            <div class="burger">

                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>

            </div>

        </nav>
        
        <div class="box-main">

            <div class="notice-paras">
                <p class="text-big" style="color: #FF612F;">Notice*</p>
                <p class="text-sm" align="justify">
                   <?php
                        echo "<h4>".$data["notice"]."</h4><br><br>";
                        if(isset($_SESSION["start"]))
                        {
                            echo "<h4 style='color:DarkRed;'>Voting is Live Now!<a href='php/login.php'>Go for Vote</a></h4>";
                        }	
		            ?>
                </p>
            </div>

            <div class="notice-img blink ">
                <img src="image/alert.png" alt="img">
            </div>
            
        </div>
    </section>

    <!---->
    <section id="about" class="infoSection">

        <div class="info-paras">
            <p class="text-big secTag">Introduction</p>
            <p class="text-sm secSubTag" align="justify">We provide plat-form to conduct voting online.by using this
                platform you can conduct voting and can give vote from anywhere around the globe.</p>
        </div>

        <div class="info-img">
            <img src="image/VoteImg.jpg" alt="img" class="imgFluid">
        </div>

    </section>

    <section class="infoSection infoleft">

        <div class="info-paras">
            <p class="text-big secTag">How To Participate In Online Voting</p>
            <p class="text-sm secSubTag" align="justify">First you have to Register on our website with your email and
                voter id card.Then login with email id and select voting section.Then you redirect to page where you can
                give vote.Voting timeings are giving on Notice Section on home page.</p>
        </div>

        <div class="info-img">
            <img src="image/ParticipentImg.jpeg" alt="img"
                class="imgFluid">
        </div>

    </section>

    <section class="contact">

        <h2 class="text-head">Contact US</h2>
        <div class="form"> 
            <input type="text" class="form-input" type="text" name="name" id="name" placeholder="Enter Your Name">
            <input type="tel" class="form-input" type="text" name="phoneno" id="phoneno" placeholder="Enter Your Phone Number">
            <input type="email" class="form-input" type="text" name="email" id="email" placeholder="Enter Your Email">
            <textarea type="text" class="form-input" name="text" id="text" cols="30" rows="8" placeholder="Ellaborate Your concern"></textarea>
             <button class="btn btn-grey">Submit</button>
        </div>
      
    </section>

    <footer>
        <p class="text-footer">Copyrigth &copy; 2025 www.e-Voting.com </p>
    </footer>

    <script defer src="js/burgermenu.js"></script>

</body>

</html>