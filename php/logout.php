<?php
session_start();
if(!isset($_SESSION["udata"]))
{
    header("Location:http://localhost/eVoting/php/login.php");
}
else{
    unset($_SESSION["udata"]);
    unset($_SESSION["id"]);
    header("Location:http://localhost/eVoting/index.php");
}
?>