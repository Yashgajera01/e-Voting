<?php

    include('../partial/_dbconnect.php');

    if(isset($_GET['email']) && isset($_GET['v_code']))
    {
        
        $query = mysqli_query($conn,"select*from users where useremail='$_GET[email]' and v_code='$_GET[v_code]' ");

        if($query)
        {            
            if(mysqli_num_rows($query)==1)
            {
                $result_fetch = mysqli_fetch_assoc($query);
                if($result_fetch['is_verified']==0)
                {
                    $update = mysqli_query($conn,"update users SET is_verified='1' where useremail='$result_fetch[useremail]' ");
                    if($update)
                    {
                        echo'<script>
                                alert("Email Verification Successfull");
                                window.location = "../index.php";
                            </script>';
                    }
                    else
                    {
                        echo'<script>
                                alert("Cannot Run Query of verifiy Success");
                                window.location = "../index.php";
                            </script>';   
                    }
                }
                else
                {
                    echo'<script>
                            alert("Email Already Verified");
                            window.location = "../index.php";
                         </script>';
                }

            }
            else
            {
                echo'<script>
                            alert("No Rows Selected Or No Data Availabel");
                            window.location = "../index.php";
                         </script>';
            }                    
        }
        else
        {
            echo'<script>
                    alert("Cannot Run Query");
                    window.location = "../index.php";
                 </script>';
        }
    }
    else
    {
        echo'<script>
                alert("Email Not Set");
                window.location = "../index.php";
            </script>';
    }

?>