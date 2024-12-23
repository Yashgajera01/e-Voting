<?php
session_start();
error_reporting(0);
if(!isset($_SESSION["adminid"]))
{
    header("Location:http://localhost/eVoting/index.php");
}
include("../partial/_dbconnect.php");
//for displaying election name 
$elename_query = mysqli_query($conn,"select elename from admin");
$elename = mysqli_fetch_array($elename_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-user.css">
    <link rel="stylesheet" href="../css/style-admin.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <script defer src="../js/navbar.js"></script>
    <title>Voting Result</title>
    <style>
        .navback{
            background-color: #666666;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.15);
        }
        .heading{
             margin-top: 88px;
        }
        @media only screen and (max-width:850px) {
            .v-class{
                display:none;
                opacity: 0;
            }
            .navback{
            background-color:rgba(255, 255, 255, 0);
            }
            .line{
                background-color: dodgerblue;
                box-shadow: 0px 0px 15px 5px rgb(11 30 78 / 15%);
            }
        }
    </style>
</head>
<body>

<form  method="POST" enctype="multipart/form-data">
    
    <section>
        <nav class="navbar navback">

        <ul class="nav-list">
            <div class="logo"><img src="../image/logo.jpg" alt="logo"></div>
            <li><a href="admin-controlpanel.php">Home</a></li>
            <!-- <li><a href="voterdetails.php">Voter Details</a></li> -->
            <li><a href="admin-result.php">Results</a></li>
            <li><a onclick="return confirm(' Are you sure you want to Start Voting? ');" href="start.php">Start Voting</a></li>
            <li><a onclick="return confirm(' Are you sure you want to Stop Voting? ');" href="stop.php">Stop Voting</a></li>
            <li><a href="admin-logout.php" style="float:right">Logout</a> </li>
                
        </ul>

        <div class="burger">

            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>

        </div>

        </nav>    
    </section>

    <div class="heading">
        <h2 style="text-align:center;">Result</h2>
    </div> 
    <hr style="border-color:black;">   

    <?php
        $result = mysqli_query($conn,"select SUM(votecount) from candidate");
        if(mysqli_num_rows($result)>0)
        {
            while($r=mysqli_fetch_array($result))
            {
                $total_votes = $r["SUM(votecount)"]; 
            }
        }  

        $user = mysqli_query($conn,"select COUNT(useremail) from users");
        if(mysqli_num_rows($user)>0)
        {
            while($u=mysqli_fetch_array($user))
            {
                $total_user = $u["COUNT(useremail)"]; 
            }
        }  

        $select = mysqli_query($conn,"select * from candidate"); 
        if(!isset($_SESSION["start"]))
        {
          
        echo "<table class=result>";    
        echo "<th>Photo</th><th>Candidate Name</th><th>Party Name</th><th>Election Name</th><th>Obtain Votes</th><th>Winning Status</th></tr>";

            if(mysqli_num_rows($select)>0)
            {
                while($row=mysqli_fetch_array($select))
                {    
                    $votes = $row["votecount"];    
                    $per = (($votes/$total_user)*100);
                    $p = number_format($per,2);
                    
                    ?>
                    <td><img src="../uploads/<?php echo $row["canphoto"]?>" height="50px" width="50px"/></td>
                    <?php
                    echo "<td>".$row["canname"]."</td>";
                    echo "<td>".$row["partyname"]."</td>";
                    echo "<td>".$elename["elename"]."</td>";
                    echo "<td>".$votes."</td>";
                    echo "<td>".$p."%</td></tr>";
                    
                }
            }    
        echo "<tr><th colspan=6>Total Votes:  ".$total_votes."</th></tr>";
        echo "<tr><th colspan=6>Total User:  ".$total_user."</th></tr>";    
        echo"</table>";
        
        }
        else
        {
            echo "<center><h2>When Voting is Stop. You can see Result</h2></center>";
        }
    ?>  


</form>

<script defer src="../js/burgermenu.js"></script>
</body>
</html>