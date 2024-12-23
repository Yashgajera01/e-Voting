<?php
session_start();

if(!isset($_SESSION["adminid"]))
{
    header("Location:http://localhost/eVoting/index.php");
}

include('../partial/_dbconnect.php');

$id = $_GET["id"];
$remove = mysqli_query($conn,"delete from candidate where canid=".$id);

if($remove)
{
    echo '<script>
                    alert("Remove SuccessFully");
                    window.location = "admin-controlpanel.php";
           </script>';
}
else
{
    echo '<script>
                    alert("Some error Occur!!!");
                    window.location = "admin-controlpanel.php";
           </script>';
}
?>