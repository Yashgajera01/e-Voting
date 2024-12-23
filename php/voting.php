<?php
session_start();

if(!isset($_SESSION["udata"]))
{
    header("Location:http://localhost/eVoting/php/login.php");
}
include("../partial/_dbconnect.php");
$elename_query = mysqli_query($conn,"select elename from admin");
$elename = mysqli_fetch_array($elename_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-user.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <script defer src="../js/navbar.js"></script>

    <title>voting page</title>
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

        <section class="votepage">

            <?php
                if(isset($_SESSION["start"]))
                {                  
                    if(isset($_SESSION["candata"]))
                    {
                        $candata = $_SESSION["candata"]; // for display votepage data 
            ?>

                        <center><h1 style="color: white;"><?php echo $elename["elename"];?></h1> </center>

                        <br>
                        <?php
                            for($i=0; $i<count($candata); $i++)
                            {
                        ?>              

            <div class="card">

                                <div class="can-card">
                                    <img src="../uploads/<?php echo $candata[$i]["canphoto"]?>" style="height: 130px; width: 130px;">
                                    <div class="can-info">
                                        <h3>About</h3>
                                        <p><?php echo $candata[$i]["description"]?></p>
                                    </div>
                                </div>
                                
                                <div id="can-info2">
                                    <h2><?php echo $candata[$i]["canname"]?></h2>
                                    
                                    <form action="vote.php" method="POST">
                                                                        
                                        <input type="hidden" name="cvotes" value="<?php echo $candata[$i]["votecount"]?>"/>                                    
                                        <input type="hidden" name="cid" value="<?php echo $candata[$i]["canid"]?>"/>
                                        
                                        <?php
                                            if($_SESSION["udata"]["is_voted"]==0)
                                            {
                                        ?>
                                                <input type="submit" name="votebtn" value="Vote" class="votebtn"/> 
                                        <?php
                                            }
                                            else
                                            {
                                        ?>           
                                                <button disabled type="button" name="votebtn" value="Voted" class="votedbtn">Voted</button>                                   
                                                
                                        <?php
                                            }
                                        ?>        
                                    </form>    
                                </div>
            </div>
                        <?php                    
                            }
                        }
                    else
                    {
                        ?>

                        <div style="margin-top:200px">
                            <center><img style="margin-bottom:10px" src="../image/emoji.png" height="100px" width="100px"/></center>
                            <center><b style="color:white;">No Candidate available right now.</b></center>    
                        </div>

                    <?php    
                    }                 
                } 
                else
                {
                    ?>
                        <div style="margin-top:200px">
                            <center><img style="margin-bottom:10px" src="../image/emoji.png" height="100px" width="100px"/></center>
                            <center><b style="color:white;">Voting Not Started Yet. Or Voting is Stop</b></center> 
                        </div>
                    <?php
                }   
                ?>

        </section>
        
    </section>

    <script defer src="../js/burgermenu.js"></script>
</body>
</html>