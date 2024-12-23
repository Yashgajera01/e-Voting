<?php
session_start();

if(!isset($_SESSION["adminid"]))
{
    header("Location:http://localhost/eVoting/admin-login.php");
}

include("../partial/_dbconnect.php");

    $resetcan = mysqli_query($conn,"truncate table candidate");
    $resetstatus = mysqli_query($conn,"update users SET is_voted=0");
    $resettitle = mysqli_query($conn,"update admin SET elename='NoElection'");
    if($resetstatus and $resettitle)
    {       
        $_SESSION["udata"]["is_voted"] = 0;
        unset($_SESSION["start"]);
        unset($_SESSION["candata"]);
 
        echo '<script>
                    alert("Reset SuccessFully!!");
                    window.location = "admin-controlpanel.php";
            </script>';

    }
    else
    {
        echo '<script>
                alert("Some Error Occured!!");
                window.location = "admin-controlpanel.php";
              </script>';
    }

?>