<?php
    session_start();

    if(!isset($_SESSION["adminid"]))
    {
        header("Location:http://localhost/eVoting/php/admin-login.php");
    }

    if(isset($_SESSION['start']))
    {
        unset($_SESSION['start']);
        echo '<script>
            alert("Voting Stopped.");
            window.location = "admin-controlpanel.php";
            </script>';
    }
    else{
        echo '<script>
            alert("Already Stop!");
            window.location = "admin-controlpanel.php";
            </script>';
    }
?>