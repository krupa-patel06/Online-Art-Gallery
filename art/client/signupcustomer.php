<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <title>Customer Sign Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
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
    <style>
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
    </style>
</head>

<body>

    <?php
    include_once '../connection.php';
    require 'claviska/SimpleImage.php';

    $err = 1;

    if (isset($_POST['btn_signup']) && !empty($_POST['btn_signup'])) {
        $firstname = $lastname = $username = $password = $email_id = $contact_number = $city = $address = $dob = $favourites = $img = $image = $name = $tmp_name = $error = "";
        if (!empty($_POST['firstname'])) {
            if (!empty($_POST['lastname'])) {
                if (!empty($_POST['username'])) {
                    if (!empty($_POST['password'])) {
                        if (!empty($_POST['confirm_password'])) {
                            if (!empty($_POST['email_id'])) {
                                if (!empty($_POST['contact_number'])) {

                                    $firstname = ucwords($_POST['firstname']);
                                    $_SESSION['signupcustomer_fname'] = $firstname;
                                    $lastname = ucwords($_POST['lastname']);
                                    $_SESSION['signupcustomer_lname'] = $lastname;
                                    $username = $_POST['username'];
                                    $_SESSION['signupcustomer_uname'] = $username;
                                    if (strlen($_POST['password']) >= 8) {
                                        if ($_POST['password'] != $_POST['confirm_password']) {
                                            echo "<script type='text/javascript'>alert('Password Not Matched')</script>";
                                        } else {
                                            if (strlen($_POST['contact_number']) == 10 && ($_POST['contact_number'][0] == "9" || $_POST['contact_number'][0] == "8" || $_POST['contact_number'][0] == "7")) {
                                                $password = $_POST['password'];
                                                $email_id = $_POST['email_id'];
                                                $_SESSION['signupcustomer_mail'] = $email_id;
                                                $contact_number = $_POST['contact_number'];
                                                $customer_status = "active";


                                                if (!empty($_FILES['ProfileImage']['name'])) {
                                                    $userdir = "./arts_files/Customer/" . $username . "/";
                                                    if (!is_dir($userdir)) {
                                                        mkdir($userdir);
                                                    }

                                                    $target_dir = $userdir . "Profile-Image/";
                                                    if (!is_dir($target_dir)) {
                                                        mkdir($target_dir);
                                                    }
                                                    $target_file = $target_dir . substr(md5(time()), 0, 8) . "-" . basename($_FILES["ProfileImage"]["name"]);
                                                    $uploadOk = 1;
                                                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                                                    if (isset($_POST["btn_signup"])) {
                                                        // Check if image file is a actual image or fake image
                                                        $check = getimagesize($_FILES["ProfileImage"]["tmp_name"]);
                                                        if ($check !== false) {
                                                            //echo "File is an image - " . $check["mime"] . ".";
                                                            $uploadOk = 1;
                                                        } else {
                                                            echo "<script type='text/javascript'>alert('File is not an image.')</script>";
                                                            //echo "File is not an image.";                                
                                                            $uploadOk = 0;
                                                        }
                                                    }
                                                    // Check if file already exists
                                                    if (file_exists($target_file)) {
                                                        echo "<script type='text/javascript'>alert('Sorry, file already exists.')</script>";
                                                        //echo "Sorry, file already exists.";
                                                        $uploadOk = 0;
                                                    }
                                                    // Check file size
                                                    if ($_FILES["ProfileImage"]["size"] > 50000000000) {
                                                        echo "<script type='text/javascript'>alert('Sorry, your file is too large.')</script>";
                                                        //echo "Sorry, your file is too large.";
                                                        $uploadOk = 0;
                                                    }
                                                    // Allow certain file formats
                                                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                                        echo "<script type='text/javascript'>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
                                                        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                                        $uploadOk = 0;
                                                    }
                                                    // Check if $uploadOk is set to 0 by an error
                                                    if ($uploadOk == 0) {
                                                        echo "<script type='text/javascript'>alert('Sorry, your file was not uploaded.')</script>";
                                                        //echo "Sorry, your file was not uploaded.";
                                                        // if everything is ok, try to upload file
                                                    } else {
                                                        if (move_uploaded_file($_FILES["ProfileImage"]["tmp_name"], $target_file)) {
                                                            $err = 0;
                                                            //echo "The file " . basename($_FILES["ProfileImage"]["name"]) . " has been uploaded.";
                                                        } else {
                                                            echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your file.')</script>";
                                                            //echo "Sorry, there was an error uploading your file.";
                                                        }
                                                    }
                                                } else {
                                                    $target_file = "";
                                                }

                                                $p = "SELECT * FROM tbl_customer WHERE customer_name='" . $username . "' ";
                                                $s = mysqli_query($conn, $p);
                                                $countt = mysqli_fetch_row($s);
                                                if ($countt > 0) {
                                                    echo "<script type=\"text/javascript\">window.alert('Username Already Exists!');window.location.href = 'signupcustomer.php';</script>";
                                                } else {
                                                    $q = "SELECT * FROM tbl_artist WHERE artist_username='" . $username . "' ";
                                                    $r = mysqli_query($conn, $q);
                                                    $count = mysqli_fetch_row($r);
                                                    if ($count > 0) {
                                                        echo "<script type=\"text/javascript\">window.alert('Username Already Exists As Artist!');window.location.href = 'signupcustomer.php';</script>";
                                                    } else {
                                                        if ($err == 0) {
                                                            $q = "INSERT INTO  tbl_customer VALUES ('', '$firstname' , '$lastname' , '$username' , '$password' , '$email_id' , '$contact_number' , '' , '$target_file' , '$customer_status')";
                                                            if (mysqli_query($conn, $q)) {
                                                                include './signupcustomer-mail.php';
                                                                echo "<script>swal('Done.!', 'Registration Done Successfully.!', 'success');</script>";
                                                            } else {
                                                                echo "<script>swal('Opps.!', 'Something Went Wrong , Try Again .!', 'error');</script>";
                                                            }
                                                        }
                                                    }
                                                }
                                            } else {
                                                echo "<script>swal('Opps.!', 'Invalid Contact Number .!', 'error');</script>";
                                            }
                                        }
                                    } else {
                                        echo "<script>swal('Opps.!', 'Password  Length Must Be Greater Than 8 Caharacters.!', 'error');</script>";
                                    }
                                } else {
                                    echo "<script>swal('Opps.!', 'Enter Contact Number .!', 'error');</script>";
                                }
                            } else {
                                echo "<script>swal('Opps.!', 'Enter Email-Id .!', 'error');</script>";
                            }
                        } else {
                            echo "<script>swal('Opps.!', 'Enter Confirm_Password .!', 'error');</script>";
                        }
                    } else {
                        echo "<script>swal('Opps.!', 'Enter Password .!', 'error');</script>";
                    }
                } else {
                    echo "<script>swal('Opps.!', 'Enter username .!', 'error');</script>";
                }
            } else {
                echo "<script>swal('Opps.!', 'Enter Lastname .!', 'error');</script>";
            }
        } else {
            echo "<script>swal('Opps.!', 'Enter Firstname .!', 'error');</script>";
        }
        header("Location: collector_home.php");
    }

    //        echo "<br>" . $_POST['firstname'];
    //        echo "<br>" . $_POST['lastname'];
    //        echo "<br>" . $_POST['username'];
    //        echo "<br>" . $_POST['password'];
    //        echo "<br>" . $_POST['confirm_password'];
    //        echo "<br>" . $_POST['email_id'];
    //        echo "<br>" . $_POST['contact_number'];
    //        echo "<br>" . $_POST['city'];
    //        echo "<br>" . $_POST['dob'];
    //        echo "<br>" . $_POST['address'];
    //        echo "<br>" . $_POST['favourites'];
    ?>

<div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
            <div class="login100-pic js-tilt" style="padding-top:190px;" data-tilt>
                    <a href="visitor_home.php" class="site-logo-anch">
                        <img src="arts_files/images/logo13.jpg" width="220" height="220" alt="Vision" style="margin-top: 20%;">
                    </a>
                    <!--<img src="arts_files/Signup/img-02.png" alt="IMG">-->
            </div>
                <form class="login100-form" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <h2 style="color: #755588; text-align: center;">SIGN UP</h2>
                    <hr>

                    <!-- Firstname -->
                    <div class="wrap-input100">
                        <input class="input100" type="text" name="firstname" placeholder="Firstname" id="firstname" required>
                        <div id="firstname-error" class="error-message">Firstname should only contain letters and be between 2 and 30 characters.</div>
                    </div>

                    <!-- Lastname -->
                    <div class="wrap-input100">
                        <input class="input100" type="text" name="lastname" placeholder="Lastname" id="lastname" required>
                        <div id="lastname-error" class="error-message">Lastname should only contain letters and be between 2 and 30 characters.</div>
                    </div>

                    <!-- Username -->
                    <div class="wrap-input100">
                        <input class="input100" type="text" name="username" placeholder="Username" id="username" required>
                        <div id="username-error" class="error-message">Username should be 5-20 characters long and contain only letters and numbers.</div>
                    </div>

                    <!-- Password -->
                    <div class="wrap-input100">
                        <input class="input100" type="password" name="password" placeholder="Password" id="password" required>
                        <div id="password-error" class="error-message"></div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="wrap-input100">
                        <input class="input100" type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password" required>
                        <div id="confirm-password-error" class="error-message">Passwords do not match.</div>
                    </div>

                    <!-- Email -->
                    <div class="wrap-input100">
                        <input class="input100" type="email" name="email_id" placeholder="Email Id" id="email_id" required>
                        <div id="email-error" class="error-message">Please enter a valid email address.</div>
                    </div>

                    <!-- Contact Number -->
                    <div class="wrap-input100">
                        <input class="input100" type="text" name="contact_number" placeholder="Contact Number" id="contact_number" required>
                        <div id="contact-error" class="error-message">Contact number should start with 7, 8, or 9 and contain exactly 10 digits.</div>
                    </div>

                    <!-- Profile Image -->
                    <center><label class="login100-form-text" style="font-weight: bold;">Profile Image</label></center>
                    <div class="wrap-input100">
                        <input class="input100" type="file" name="ProfileImage" id="ProfileImage" accept=".jpg,.jpeg,.png,.gif">
                    </div>

                    <!-- Submit Button -->
                    <div class="container-login100-form-btn">
                        <input type="submit" name="btn_signup" class="login100-form-btn" value="Sign Up">
                    </div>

                    <div class="text-center p-t-12">
                        <a class="txt2" href="signin.php">Back To Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Validation Patterns
        const namePattern = /^[A-Za-z]{2,30}$/; // Only letters, 2-30 characters
        const usernamePattern = /^[A-Za-z0-9]{5,20}$/; // Alphanumeric, 5-20 characters
        const passwordPattern = /^(?=.[a-z])(?=.[A-Z])(?=.*\d).{6,}$/; // Password requirements
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email format
        const contactPattern = /^[789]\d{9}$/; // Starts with 7, 8, or 9 and has 10 digits

        // Real-time Validation Functions
        document.getElementById("firstname").addEventListener("input", function() {
            validateField("firstname", namePattern, "firstname-error");
        });

        document.getElementById("lastname").addEventListener("input", function() {
            validateField("lastname", namePattern, "lastname-error");
        });

        document.getElementById("username").addEventListener("input", function() {
            validateField("username", usernamePattern, "username-error");
        });

        document.getElementById("password").addEventListener("input", function() {
            validatePassword();
            validateConfirmPassword(); // Also check if passwords match in real-time
            });


        document.getElementById("confirm_password").addEventListener("input", validateConfirmPassword);

        document.getElementById("email_id").addEventListener("input", function() {
            validateField("email_id", emailPattern, "email-error");
        });

        document.getElementById("contact_number").addEventListener("input", function() {
            validateField("contact_number", contactPattern, "contact-error");
        });

        function validateField(fieldId, pattern, errorId) {
            const field = document.getElementById(fieldId).value;
            if (!pattern.test(field)) {
                document.getElementById(errorId).style.display = "block";
            } else {
                document.getElementById(errorId).style.display = "none";
            }
        }
        function validatePassword() {
            const password = document.getElementById("password").value;
            const passwordError = document.getElementById("password-error");
            if (!passwordPattern.test(password)) {
                passwordError.style.display = "block";
            } else {
                passwordError.style.display = "none";
            }
    }
        function validateConfirmPassword() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm_password").value;
            const confirmPasswordError = document.getElementById("confirm-password-error");
            if (confirmPassword && password !== confirmPassword) {
                confirmPasswordError.style.display = "block";
            } else {
                confirmPasswordError.style.display = "none";
            }
        }

        function validateForm() {
            const errors = document.querySelectorAll('.error-message');
            let valid = true;

            // Check if there are any visible error messages
            errors.forEach(error => {
                if (error.style.display === "block") {
                    valid = false;
                }
            });

            // Profile Image Validation
            const profileImage = document.getElementById("ProfileImage").files[0];
            if (profileImage) {
                const allowedTypes = ["image/jpeg", "image/png", "image/gif"];
                if (!allowedTypes.includes(profileImage.type)) {
                    alert("Only JPG, JPEG, PNG & GIF files are allowed.");
                    return false;
                }
                if (profileImage.size > 5000000) { // 5MB
                    alert("File size should be less than 5MB.");
                    return false;
                }
            }

            return valid;
        }
    </script>

                    <?php
                    //                        $q = "select * from tbl_city order by city_name";
                    ?>
                    <!--                        <div class="wrap-input100" >
                                                    <select class="input100" style="outline:none;" name="city">-->
                    <?php
                    //                                foreach ($connection->query($q) as $row) {
                    //                                    echo "<option class=input100 value=" . $row['city_name'] . ">";
                    //                                    echo $row['city_name'];
                    //                                    echo "</option>";
                    //                                }
                    ?>
                    <!--                            </select>
                                                    <span class="focus-input100"></span>
                                                </div>-->

                    <!--                        <div class="wrap-input100">
                                                    <input class="input100" type="text" name="address" placeholder="Address">
                                                    <span class="focus-input100"></span>
                                                </div>                        -->

                    <!--                        <div class="wrap-input100" >
                                                    <input class="input100" type="date" name="dob" placeholder="Date Of Birth">
                                                    <span class="focus-input100"></span>
                                                </div>                                   -->

                    <!--                        <?php
                                                //$q = "select * from tbl_subcategory order by subcategory_name";
                                                ?>
                                                <div class="wrap-input100 validate-input" >
                                                    <table>
                        <?php // ($connection->query($q) as $row) {   
                        ?>                                                        
                                                            <tr>
                                                                <td>
                                                                    <label class="checkbox-inline">
                                                                        <span class="col-2"></span>
                                                                        <input type="checkbox" name="favourites[]" value="<?php  //echo $row['subcategory_name']          
                                                                                                                            ?>" >                                    
                        <?php //echo $row['subcategory_name'];   
                        ?>
                                                                    </label>
                                                                </td> 
                                                            </tr>   
                        <?php //}   
                        ?>
                                                    </table>
                                                </div>-->

                    </div>
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
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>