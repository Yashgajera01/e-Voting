<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Signup</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
  <link rel="stylesheet" href="../css/style-login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-form">
  <form method="POST" enctype="multipart/form-data">
    <h1>SignUp</h1>
    <div class="content">

        <div class="input-field">
            <input type="text" name="name" placeholder="Enter Name" autocomplete="nope" required>
        </div>
      
        <div class="input-field">
            <input type="email" name="email" placeholder="Email" autocomplete="nope" required>
        </div>
        <div class="input-field">
            <input type="password" name="password" placeholder="Password" autocomplete="new-password" required>
        </div>
        <div class="input-field">
            <input type="tel" maxlength="12" name="aadharNumber" placeholder="Aadhar Number" autocomplete="nope" required>
        </div>
        <div class="input-field">
            <input type="tel" maxlength="10" name="mobileno" placeholder="Phone Number" autocomplete="nope">
        </div>
        <div class="input-field">
            <input type="file" name="image" placeholder="Upload Your Image" autocomplete="nope" required>
        </div>

        <a href="#" class="link">Forgot Your Password?</a>
    </div>

    <div class="action">
    <button><a href="../index.php" style="text-decoration: none;color:black;">Back</a></button>
    <button type="submit" name="register">Register</button>
    </div>
  </form>
</div>

</body>
</html>


<?php
error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require '../vendor/autoload.php';

function sendMail($email,$v_code)
{
    $mail = new PHPMailer(true);

    try 
    {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '';     //SMTP username (email)
        $mail->Password   = '';     //SMTP password (passkey)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; ;       //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        $mail->setFrom('Your Mail', 'OnlineElectionSystem');
        $mail->addAddress($email);   
            
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email Verification From Online Election System';
        $mail->Body    = "Thanks For Registration!
                          Click The link below To verify the email address
                          <a href='http://localhost/evoting/php/emailverify.php?email=$email&v_code=$v_code'>Verify</a>";
       
        $mail->send();
        // echo "Sent";
        return true;
    } 
    catch (Exception $e) 
    {
        // echo "error".$e;
        return false;
    }
    
}


function aadharValidation($aadharNumber) 
{
	/*...multiplication table...*/
	$multiplicationTable = [
		[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
		[1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
		[2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
		[3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
		[4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
		[5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
		[6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
		[7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
		[8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
		[9, 8, 7, 6, 5, 4, 3, 2, 1, 0],
	];
	/*...permutation table...*/
	$permutationTable = [
		[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
		[1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
		[5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
		[8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
		[9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
		[4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
		[2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
		[7, 0, 4, 6, 9, 1, 3, 2, 5, 8],
	];
	/*...split aadhar number...*/
	$aadharNumberArr = str_split($aadharNumber);
	/*...check length of aadhar number...*/
	if (count($aadharNumberArr) == 12) {
		/*...reverse aadhar number...*/
		$aadharNumberArrRev = array_reverse($aadharNumberArr);
		$tableIndex         = 0;
		/*...validate...*/
		foreach ($aadharNumberArrRev as $aadharNumberArrKey => $aadharNumberDetail) {
			$tableIndex = $multiplicationTable[$tableIndex][$permutationTable[($aadharNumberArrKey % 8)][$aadharNumberDetail]];
		}
		return ($tableIndex === 0);
	}
	return false;
}


if(isset($_POST["register"]))
{ 

    $nm = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $hashed_pass =  password_hash($pass, PASSWORD_DEFAULT);
    $tel = $_POST["mobileno"];
    $aad = $_POST["aadharNumber"];
    $img = $_FILES["image"]["name"];
    $i = $_FILES["image"]["tmp_name"];
    $v_code = bin2hex(random_bytes(8));


    include('../partial/_dbconnect.php');


    $folder = "../uploads/".$img;
    move_uploaded_file($i,$folder);

        if(aadharValidation($aad))
        {
            $query = "INSERT INTO users(username, useremail, userpass, phoneno, aadharno, is_voted, v_code, is_verified, userphoto, tstamp) VALUES ('$nm', '$email', '$hashed_pass', '$tel', '$aad', '0', '$v_code', '0', '$img', current_timestamp())";
  
            $q = mysqli_query($conn,$query);
            if($q && sendMail($email,$v_code))
            {    
                echo '<script>
                        alert("Registertion Successful");
                        window.location = "../index.php";
                    </script>';        
            }
            else
            {
                echo '<script>
                        alert("Something Went Wrong!! Or Email or Aadhar is already Registered");
                        window.location = "signup.php";
                    </script>';
            }
        }
        else
        {
            echo '<script>
                    alert("Aadhar Number Is Not Valid.");
                    window.location = "register.php";
                </script>'; 
        }
}

?>
