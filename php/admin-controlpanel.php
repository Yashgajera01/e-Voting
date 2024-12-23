<?php
    session_start();

    if(!isset($_SESSION["adminid"]))
    {
        header("Location:http://localhost/eVoting/php/admin-login.php");
    }
    
    include('../partial/_dbconnect.php');

    $q = mysqli_query($conn,"select * from candidate");
    $elename_query = mysqli_query($conn,"select elename from admin");
    $elename = mysqli_fetch_array($elename_query);
    $n=mysqli_num_rows($q);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/style-admin.css">
    <script defer src="../js/navbar.js"></script>

    <title>Admin-dashboard</title>
    <style>    
        /*results*/
        .result {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        text-align: center;
        }

        .result th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: dodgerblue;
        color: white;
        text-align: center;
        }

        .result td,
        .result th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        .result tr:nth-child(even) {
        background-color: #f2f2f2;
        }

        .result tr:hover {
        background-color: #ddd;
        }

        .removebtn
        {
        background-color: #666666;
        font-weight: 500;
        font-size: 16px;
        color: aliceblue;
        border-radius: 5px;
        width: 80px;
        height: 32px;
        }
        .removebtn a
        {
        color: aliceblue;
        text-decoration: none;
        }
    </style>

</head>
<body>

    <section class="backgroud main-Section">

        <nav class="navbar">

            <ul class="nav-list">
                <div class="logo"><img src="../image/logo.jpg" alt="logo"></div>
                <li><a href="admin-controlpanel.php">Home</a></li>
                <!-- <li><a href="voterdetails.php">Voter Details</a></li> -->
                <li><a href="admin-result.php">Results</a></li>
                <li><a onclick="return confirm(' Are you sure you want to Start Voting? ');" href="start.php">Start Voting</a></li>
                <li><a onclick="return confirm(' Are you sure you want to Stop Voting? ');" href="stop.php">Stop Voting</a></li>
                <li><a href="reset.php">Reset</a></li>
                <li><a href="admin-logout.php" style="float:right">Logout</a> </li>
                    
            </ul>
    
            <div class="burger">

                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>

            </div>

        </nav>

        <section class="notice">
            <div class="notice-form">
                <form method="post">
                    <h1>Add Notice</h1>
                    <div class="content">
                        <div class="input-field">
                            <input type="text" name="notice" placeholder="Notice" autocomplete="nope">
                        </div>
                    </div>
                    <div class="action">
                        <button type="submit">Add</button>
                    </div>
                </form>
            </div>

            <div class="notice-form">
                <form method="post">
                    <h1>Election Name</h1>
                    <div class="content">
                        <div class="input-field">
                            <input type="text" name="elename" placeholder="Election Name" autocomplete="nope">
                        </div>
                    </div>
                    <div class="action">
                        <button type="submit">Ok</button>
                    </div>
                </form>
            </div>
        </section>

    </section>

    <section class="addcan" style="height: 910px">

        <form method="post" enctype="multipart/form-data">
            <h2 class="text-head">Add Candidate</h2>
            <div class="form"> 
                <input type="text" class="form-input" type="text" name="name" id="name" placeholder="Candidate Name" required>
                <input type="text" class="form-input" type="text" name="partyname" id="partyname" placeholder="Party Name" required>
                <input type="tel" maxlength="12" class="form-input" type="text" name="aadharno" id="aadharno" placeholder="Aadhar Number" required>
                <input type="tel" maxlength="10" class="form-input" type="text" name="phoneno" id="phoneno" placeholder="Phone Number" required>
                <input type="email" class="form-input" type="text" name="email" id="email" placeholder="Email" required>
                <input type="file" class="form-input" name="image" placeholder="Upload Candidate Image" autocomplete="nope" required>
                <textarea type="text" class="form-input" name="about" id="about" cols="30" rows="8" placeholder="About Candidate"></textarea>
                <button class="btn btn-grey" type="submit" name="addcan">Add</button>
            </div>
      </form>
    </section>

<!--candidate details-->
    <section>

        <form  method="POST" enctype="multipart/form-data">

            <div>
                <h2 style="text-align: center;margin-top: 8px;">Candidate Details</h2>
            </div> 
            <br>
            <div>
                  
                <table class="result">
                    <tr>
                        <th>Photo</th><th>Candidate Name</th><th>Party Name</th><th>Candidate Email</th><th>Candidate MobileNo.</th><th>Election Name</th><th>Action</th>
                    </tr>

                    <?php
                        while($row=mysqli_fetch_array($q))
                        {
                    ?>
                            <tr>
                                <td><img src="../uploads/<?php echo $row["canphoto"]?>" height="50px" width="50px"/></td>
                                <?php
                                    echo "<td>".$row["canname"]."</td>";
                                    echo "<td>".$row["partyname"]."</td>";
                                    echo "<td>".$row["canemail"]."</td>";
                                    echo "<td>".$row["phoneno"]."</td>";
                                    echo "<td>".$elename["elename"]."</td>";
                                ?>
                                <td><button class="removebtn"><a onclick="return confirm('Are you sure you want to Remove?');" href="delete.php?id=<?php echo $row["canid"]?>">Remove</a></button></td>
                            </tr>
                    <?php } ?>
                </table>
            </div>    

        </form>
                
    </section>

    <script defer src="../js/burgermenu.js"></script>
</body>
</html>

<?php

if(isset($_POST['notice']))
{
    $notice = $_POST['notice'];

    $sql = "update admin set notice='".$notice."' ";
    $result = mysqli_query($conn, $sql);

    if($result)
    {
        echo '<script>
                alert("Notice added successfully");
                window.location = "admin-controlpanel.php";
            </script>';
    }
    else
    {
        echo '<script>
                alert("Failed to add notice");
                window.location = "admin-controlpanel.php";
            </script>';
    }
}

if(isset($_POST['elename']))
{
    $elename = $_POST['elename'];

    $sql = "update admin set elename='".$elename."' ";
    $result = mysqli_query($conn, $sql);

    if($result) 
    {
        echo '<script>
                alert("Election Name updated successfully");
                window.location = "admin-controlpanel.php";
            </script>';
    }
    else
    {
        echo '<script>
                alert("Failed to update Election Name");
                window.location = "admin-controlpanel.php";
            </script>';
    }
}

if(isset($_POST['addcan']))
{
    $name = $_POST['name'];
    $partyname = $_POST['partyname'];
    $aadharno = $_POST['aadharno'];
    $phoneno = $_POST['phoneno'];
    $email = $_POST['email'];
    $about = $_POST['about'];
    $image = $_FILES['image']['name'];
    $i = $_FILES['image']['tmp_name'];

    $folder = "../uploads/".$image;
    move_uploaded_file($i,$folder);

    $sql = "insert into candidate (canname, partyname, canemail, phoneno, aadharno, description, canphoto) values ('$name', '$partyname', '$email', '$phoneno', '$aadharno', '$about', '$image') ";
    $result = mysqli_query($conn, $sql);

    if($result)
    {
            $cd = mysqli_query($conn,"select canid, canname, partyname, description, canphoto, votecount  from candidate");
            if(mysqli_num_rows($cd)>0)
            {
                $candata = mysqli_fetch_all($cd, MYSQLI_ASSOC);        
                $_SESSION["candata"]=$candata;
            }                 
        echo '<script>
                alert("Candidate added successfully");
                window.location = "admin-controlpanel.php";
            </script>';
    }
    else
    {
        echo '<script>
                alert("Failed to add Candidate");
                window.location = "admin-controlpanel.php";
            </script>';
    }   
}
?>