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
        <input type="email" name="eid" placeholder="Email" autocomplete="nope">
      </div>
      <div class="input-field">
        <input type="password" name="password" placeholder="Password" autocomplete="new-password">
      </div>

      <a href="#" class="link">Forgot Your Password?</a>
    </div>
    <div class="action">
      <button><a href="../index.php" style="text-decoration: none;color:black;">Back</a></button>
      <button type="submit" name="login">Login</button>
    </div>
  </form>
</div>

</body>
</html>

<?php
error_reporting(0);

if(isset($_POST["login"]))
{
    $eid = $_POST["eid"];
    $pass = $_POST["password"]; 
    
    include('../partial/_dbconnect.php');

    $q = mysqli_query($conn,"select*from users where useremail='".$eid."'");
    $udata = mysqli_fetch_array($q);
    $n=mysqli_num_rows($q);
    if($udata && password_verify($pass,$udata['userpass']))
    {               
        if($udata['is_verified']==1 )
        {        
            $_SESSION['id'] = $udata['userid'];
            $_SESSION['is_voted'] = $udata['is_voted'];//session for vote status of user
            $_SESSION['udata'] = $udata;//session for all
            
            echo '<script>
                    alert("Login Successfull")
                    window.location = "dashboard.php";
                </script>';
        }    
        else
        {
            echo '<script>
                    alert("Email Not Verified!!Please Verify Email First")
                    window.location = "../index.php";
                </script>';
        }
    }
    else
    {
        echo '<script>
                    alert("Invalid Id or Password!!")
                    window.location = "login.php";
              </script>';
    }
  
}
?>
