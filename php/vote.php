<?php
session_start();

if(!isset($_SESSION["udata"]))
{
    header("Location:http://localhost/eVoting/php/login.php");
}

    include("../partial/_dbconnect.php");

    $votes = $_POST["cvotes"];
    $total_votes = $votes+1;
    $cid = $_POST["cid"];
    $uid = $_SESSION["udata"]["userid"];
    
    $update_votes = mysqli_query($conn,"update candidate SET votecount ='$total_votes' where canid ='$cid' ");
    $update_user_status = mysqli_query($conn,"update users SET is_voted=1 where userid ='$uid' ");
    

    if($update_votes and $update_user_status)
    {
        $cd = mysqli_query($conn,"select canid, canname, partyname, description, canphoto, votecount  from candidate");
        $candata = mysqli_fetch_all($cd,MYSQLI_ASSOC);
        $_SESSION["candata"]=$candata;

        $_SESSION["udata"]["is_voted"] = 1;

        echo '<script>
                    alert("Voting SuccessFully!!");
                    window.location = "dashboard.php";
                </script>';

    }
    else
    {
        echo '<script>
                alert("Some Error Occured!!");
                window.location = "dashboard.php";
              </script>';
    }
 
?>