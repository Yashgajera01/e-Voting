<?php
session_start();

if(!isset($_SESSION["udata"]))
{
    header("Location:http://localhost/eVoting/php/login.php");
}
    
    $data = $_SESSION["udata"]; //for profile 
      
    if($_SESSION["udata"]["is_voted"]==0)
    {
        $status = '<b style="color:red">Not Voted</b>';
    }
    else
    {
        $status = '<b style="color:green">Voted</b>';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-user.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <script defer src="../js/navbar.js"></script>

    <title>dashboard</title>
</head>
<body>

    <section class="backgroud main-Section">

        <nav class="navbar">

            <ul class="nav-list">
                <div class="logo"><img src="../image/logo.jpg" alt="logo"></div>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="result.php">Results</a></li>
                <li><a href="voting.php">Vote</a></li>
                <li><a href="logout.php">Logout</a></li>
                <!-- <div class="dropdown">
                    <button class="dropbtn">Vote
                      <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                      <a href="#">Link 1</a>
                      <a href="#">Link 2</a>
                      <a href="#">Link 3</a>
                    </div>
                </div> -->
            </ul>
    
            <div class="burger">

                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>

            </div>

        </nav>

        <section class="profile" style="align-items:center;">

            <div class="profile-card">
                <div class="profile-info" style="flex-direction: column;">

                    <center><img src="../uploads/<?php echo $data["userphoto"]?>" style="height: 130px; width: 130px; margin-bottom:10px;"></center>

                    <p><b>Name:</b> <?php echo $data["username"];?></p><br>
                    <p><b>Email:</b> <?php echo $data["useremail"];?></p><br>
                    <p><b>MobileNo:</b> <?php echo $data["phoneno"];?></p><br>
                    <p><b>Status:</b> <?php echo $status;?></p><br>
                    
                </div>
            </div>
        </section>
        
    </section>

    <script defer src="../js/burgermenu.js"></script>
</body>
</html>