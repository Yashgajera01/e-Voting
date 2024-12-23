<?php session_start();?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
  <link rel="stylesheet" href="../css/style-login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-form">
  <form method="post">
    <h1>Login</h1>
    <div class="content">
      <div class="input-field">
        <input type="text" name="adminid" placeholder="Admin Id" autocomplete="nope">
      </div>
      <div class="input-field">
        <input type="password" name="adminpass" placeholder="Password" autocomplete="new-password">
      </div>

      <a href="#" class="link">Forgot Your Password?</a>
    </div>
    <div class="action">
      <button><a href="../index.php" style="text-decoration: none;color:black;">Back</a></button>
      <button type="submit" name="adlogin">Login</button>
    </div>
  </form>
</div>

</body>
</html>


<?php
error_reporting(0);

if(isset($_POST["adlogin"]))
{
    $adid = $_POST["adminid"];
    $adpass = $_POST["adminpass"];


    include("../partial/_dbconnect.php");
    $q = mysqli_query($conn,"select * from admin where adminid='".$adid."' and adminpass='".$adpass."' ");

    $n=mysqli_num_rows($q);
    if($n==1)
    {
        $_SESSION["adminid"]=$adid;
        echo '<script>
                alert("Login Successfull");
                window.location = "admin-controlpanel.php";
              </script>';
    }
    else
    {        
        echo '<script>
                alert("Invalid Id or Password!!");
                window.location = "admin-login.php";
              </script>';
    }
  
}
?>
