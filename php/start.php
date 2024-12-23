<?php
    session_start();

    if(!isset($_SESSION["adminid"]))
    {
        header("Location:http://localhost/eVoting/php/admin-login.php");
    }

    $start = "strated";

    $_SESSION['start'] = $start;

    if(isset($_SESSION['start']))
    {
        echo '<script>
            alert("Voting Stared.");
            window.location = "admin-controlpanel.php";
            </script>';
    }
?>