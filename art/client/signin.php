<?php
ob_start();
session_start();
include_once '../connection.php';

// Move session_start to the beginning
if(isset($_SESSION['signin_username'])){
    if(isset($_SESSION['signin_username'])){
        if($_SESSION['signin_username'] == "artist"){
            header("Location: artist_home.php");
            exit; // Stop script execution after header redirect
        } elseif($_SESSION['signin_username'] == "collector"){
            header("Location: collector_home.php");
            exit; // Stop script execution after header redirect
        }
    }
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Sign In</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <!--===============================================================================================-->
        <script src="js/sweetalert.min.js" type="text/javascript"></script>

    </head>
    <body>
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt">
                                <a href="visitor_home.php" class="site-logo-anch">
                                         <img  src="arts_files/images/logo13.jpg" width="250" height="250" alt="Vision"style="margin-top: 25%;"> 
                                </a>                        
<!--                        <img src="arts_files/Signin/img-01.png" alt="IMG" style="padding-top: 35%;">-->
                    </div>

                    <form class="login100-form validate-form" method="post" onsubmit="return validateForm()">
                        <hr/>
                        <span class="login100-form-title">
                            <h2 style="color: #af9398">SIGN IN</h2>
                        </span>
                        <hr>
                        <div class="wrap-input100" >
                            <input class="input100" type="text" name="username" placeholder="Username">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100">
                            <input class="input100" type="password" name="password" placeholder="Password">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="container-login100-form-btn">
                            <input type="submit" name="btn_signin" class="login100-form-btn"  value="Sign In"/>
                        </div>

                        <div class="text-center p-t-12">
                            <span class="txt1">
                                Forgot
                            </span>
                            <a class="txt2" href="signin_forgot.php">
                                Username / Password?
                            </a>
                        </div>

                        <div class="text-center p-t-136" style="padding:0;">
                            <a class="txt2" href="signupselection.php">
                                Create your Account
                                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                            </a>
                        </div>

                        <script>
                        function validateForm() {
                            const password = document.getElementById("password").value;
                            const confirmPassword = document.getElementById("confirm_password").value;
                            const passwordPattern = /^(?=.[a-z])(?=.[A-Z])(?=.*\d).{8,}$/;

                            // Password Validation
                            if (!passwordPattern.test(password)) {
                                swal("Oops!", "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.", "error");
                                return false;
                            }

                            // Password Match Check
                            if (password !== confirmPassword) {
                                swal("Oops!", "Passwords do not match!", "error");
                                return false;
                            }
                            return true;
                        }
                        </script>    

<!--                        <div class="text-center p-t-12" style="padding:0;">
                            <a class="txt2" href="visitor_home.php">
                                Back To Home
                            </a>
                        </div>-->
                        <hr>
                        <?php
                        if (isset($_POST['btn_signin']) && !empty($_POST['btn_signin'])) {
                            $username = $password = "";

                            if (!empty($_POST['username']) || !empty($_POST['password']) || (!empty($_POST['username']) && !empty($_POST['password']))) {
                                $username = $_POST['username'];
                                $password = $_POST['password'];

                                $q = "select customer_username from tbl_customer where customer_username='$username'";
                                $r = mysqli_query($conn, $q);
                                $q2 = "select artist_username from tbl_artist where artist_username='$username'";
                                $r2 = mysqli_query($conn, $q2);


                                if (mysqli_num_rows($r) > 0 || mysqli_num_rows($r2) > 0) {

                                    if (mysqli_num_rows($r) > 0) {
                                        $q = "select * from tbl_customer where customer_username='$username' and customer_password='$password'";
                                        $r3 = mysqli_query($conn, $q);
                                        if (mysqli_num_rows($r3) > 0) {
                                            $q2 = "select * from tbl_customer where customer_username='$username' and customer_password='$password'"
                                                    . "and customer_status = 'active'";
                                            $r4 = mysqli_query($conn, $q2);
                                            if (mysqli_num_rows($r4) > 0) {
                                                $_SESSION['signin_username'] = $username;
                                                $_SESSION['signin_user'] = "collector";
                                                header("Location: collector_home.php");
                                            } else {
                                                echo "<script>swal('Opps.!', 'Customer Account Is Deactive .!', 'error');</script>";
                                            }
                                        } else {
                                            echo "<script>swal('Opps.!', 'Password Not Matched.!', 'error');</script>";
                                        }
                                    } else if (mysqli_num_rows($r2) > 0) {

                                        $q = "select * from tbl_artist where artist_username='$username' and artist_password='$password'";
                                        $r3 = mysqli_query($conn, $q);
                                        if (mysqli_num_rows($r3) > 0) {
                                            $q = "select * from tbl_artist where artist_username='$username' and artist_password='$password'"
                                                    . "and artist_status = 'active'";
                                            $r3 = mysqli_query($conn, $q);
                                            if (mysqli_num_rows($r3) > 0) {
                                                $_SESSION['signin_username'] = $username;
                                                $_SESSION['signin_user'] = "artist";
                                                header("Location: artist_home.php");
                                            } else {
                                                echo "<script>swal('Opps.!', 'Artist Account Is Deactive .!', 'error');</script>";
                                            }
                                        } else {
                                            echo "<script>swal('Opps.!', 'Password Not Matched.!', 'error');</script>";
                                        }
                                    }
                                } else {
                                    echo "<script>swal('Opps.!', 'Username Not Matched!', 'error');</script>";
                                }
                            } else {
                                echo "<script>swal('Sowrie.!', 'Empty Fields Are Not Allowed!', 'error');</script>";
                            }
                        }

                        unset($_POST['username']);
                        unset($_POST['password']);
                        unset($_POST['btn_signin']);
                        ?>

                    </form>
                </div>
            </div>
        </div>




        <!--===============================================================================================-->	
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/select2/select2.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/tilt/tilt.jquery.min.js"></script>
        <script >
            $('.js-tilt').tilt({
                scale: 1.1
            })
        </script>
        <!--===============================================================================================-->
        <script src="js/main.js"></script>
        <?php ob_flush(); ?>
    </body>
</html>
<?php ?>
