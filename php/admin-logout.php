<?php
session_start();
if(!isset($_SESSION["adminid"]))
{
    header("Location:http://localhost/eVoting/php/admin-login.php");
}
else{
    unset($_SESSION["adminid"]);
    header("Location:http://localhost/eVoting/index.php");
}
?>