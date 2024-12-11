<?php
include_once '../connection.php';
session_start();
ob_start();

$cid = "select customer_id from tbl_customer where customer_username = '" . $_SESSION['signin_username'] . "'";
$res_cid = mysqli_query($conn, $cid);
while ($r = mysqli_fetch_assoc($res_cid)) {
    $cid = $r['customer_id'];
}

$qty = array();
$price = array();

$q = "select * from tbl_cart where customer_id = '$cid' and cart_status = '0'";
$res_q = mysqli_query($conn, $q);

while ($r = mysqli_fetch_assoc($res_q)) {
    $qty[] = $r['qty'];
    $price[] = $r['price'];
}

$amount = 0;
for ($i = 0; $i < sizeof($qty); $i++) {
    $amt = ($price[$i] + $_SESSION['shipcost']) * $qty[$i];
    $amount = $amount + $amt;
}

$amtt = $_SESSION["totalAMT"];
?>

<?php
$action = '';

$posted = array();
if (!empty($_POST)) {
    //print_r($_POST);
    foreach ($_POST as $key => $value) {
        $posted[$key] = $value;
    }
}

$formError = 0;

if (empty($posted['txnid'])) {
    // Generate random transaction ids
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
    $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if (empty($posted['hash']) && sizeof($posted) > 0) {
    if (
        empty($posted['key']) || empty($posted['txnid']) || empty($posted['amount']) || empty($posted['firstname']) || empty($posted['email']) || empty($posted['phone']) || empty($posted['productinfo']) || empty($posted['surl']) || empty($posted['furl']) || empty($posted['streetaddress']) || empty($posted['city']) || empty($posted['state']) || empty($posted['country']) || empty($posted['zipcode'])
    ) {
        $formError = 1;
    }
}
?>
<html>

<head>
    <title>Purchase Details</title>
    <link rel="shortcut icon" type="image/x-icon" href="Images/Artboard 1.png">
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
        .error {
            color: #FF0000;
        }
    </style>
    <script>
        var hash = '<?php echo $hash ?>';

        function submitPayuForm() {
            if (hash == '') {
                return;
            }
            var payuForm = document.forms.payuForm;
            payuForm.submit();
        }
    </script>
</head>

<body>
    <?php
    if ($formError) {
        echo "<script>swal('Opps.!', 'Empty Fields Are Not Allowed.!', 'error');</script>";
    ?>
        <!--            <span style="color:red">Please fill all mandatory fields.</span>-->
    <?php } ?>
    <center>
        <form action="PayUMoney_form.php" method="post" class="" style="width: 40%; margin-left: 5%;margin-top: 3%;">
            <center>
                <div class="login100-pic js-tilt">
                    <a href="collector_home.php" class="site-logo-anch">
                        <img src="arts_files/images/logo13.jpg" width="100" height="100" alt="Art" style="margin-top: 0%;">
                    </a>
                    <!--                        <img src="arts_files/Signin/img-01.png" alt="IMG" style="padding-top: 35%;">-->
                </div>
                <br />
                <span class="login100-form-title">
                    <h2 style="color: #af9398">CHECKOUT</h2>
                </span>
                <hr>

                <div class="wrap-input100 ">
                    <input name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" class="input100" placeholder="Enter Email-Id" />
                </div>

                <div class="wrap-input100 validate-input">
                    <input name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" class="input100" placeholder="Enter firstname" />
                </div>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="txt_lastname" id="txt_lastname" value="<?php echo (empty($posted['txt_lastname'])) ? '' : $posted['txt_lastname']; ?>" placeholder="Enter Lastname" />
                </div>

                <div class="wrap-input100 validate-input">
                    <input type="text" name="amount" value="<?php echo $amtt; ?>" class="input100" readonly="true" />
                </div>

                <div class="wrap-input100 validate-input">
                    <input type="text" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" class="input100" placeholder="Enter Contact Number" />
                </div>

                <div class="wrap-input100 validate-input">
                    <input type="text" name="streetaddress" value="<?php echo (empty($posted['address'])) ? '' : $posted['address']; ?>" class="input100" placeholder="Enter Street Address" />
                </div>

                <?php
                $q = "select * from tbl_city where city_status='active' order by city_name";
                ?>
                <div class="wrap-input100">
                    <select class="input100" style="outline:none;" name="city">
                        <option class="input100" value="selected">--Select City--</option>
                        <?php
                        $res = $conn->query($q);
                        while ($row = $res->fetch_assoc()) {
                            // foreach ($conn->query($q) as $row) { 
                        ?>
                            <option class='input100' value="<?php echo $row["city_name"] ?>"> <?php echo $row["city_name"] ?> </option>
                        <?php // echo "<option class='input100' value=" . $row['city_name'] . ">";
                            // echo $row['city_name'];
                            // echo "</option>";
                        }
                        ?>
                    </select>
                    <span class="focus-input100"></span>
                </div>
                <?php
                $q = "select * from tbl_state order by state_name";
                ?>
                <div class="wrap-input100">
                    <select class="input100" style="outline:none;" name="state">
                        <option class="input100" value="selected">--Select State--</option>
                        <?php
                        $res = $conn->query($q);
                        while ($row = $res->fetch_assoc()) {
                            // foreach ($conn->query($q) as $row) { 
                        ?>
                            <option class='input100' value="<?php echo $row["state_name"] ?>"> <?php echo $row["state_name"] ?> </option>
                        <?php  // echo "<option class='input100' value=" . $row['state_name'] . ">";
                            // echo $row['state_name'];
                            // echo "</option>";
                        }
                        ?>
                    </select>
                    <span class="focus-input100"></span>
                </div>
                <?php
                $q = "select * from tbl_country order by country_name";
                ?>
                <div class="wrap-input100">
                    <select class="input100" style="outline:none;" name="country">
                        <option class="input100" value="selected">--Select Country--</option>
                        <?php
                        $res = $conn->query($q);
                        while ($row = $res->fetch_assoc()) { ?>
                            <!-- foreach ($conn->query($q) as $row) { -->
                            <option class='input100' value="<?php echo $row["country_name"] ?>"> <?php echo $row["country_name"] ?> </option>
                        <?php // echo "<option class='input100' value=" . $row['country_name'] . ">";
                            // echo $row['country_name'];
                            // echo "</option>";
                        }
                        ?>
                    </select>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input">
                    <input type="text" name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" class="input100" placeholder="Enter ZIPCODE" />
                </div>

                <div class="wrap-input100 validate-input">
                    <input type="text" value="<?php echo "Payment Method Is Cash ON Delivery"; ?>" class="input100" readonly="true" />
                </div>


                <hr />
                <div class="container-form-btn">
                    <center>
                        <?php if (!$hash) {
                        ?>
                            <input type="submit" name="btnsubmit" value="Submit" class="login100-form-btn" style="width: 30%;cursor: pointer;" />
                            <?php
                            if (isset($_POST["btnsubmit"])) {
                                $_SESSION['payemail'] = $_POST['email'];
                                $_SESSION['payufirstname'] = $_POST['firstname'];
                                $_SESSION['payutxt_lastname'] = $_POST['txt_lastname'];
                                $_SESSION['payuamount'] = $_POST['amount'];
                                $_SESSION['payuphone'] = $_POST['phone'];
                                $_SESSION['payustreetaddress'] = $_POST['streetaddress'];
                                $_SESSION['payucity'] = $_POST['city'];
                                $_SESSION['payustate'] = $_POST['state'];
                                $_SESSION['payucountry'] = $_POST['country'];
                                $_SESSION['payuzipcode'] = $_POST['zipcode'];
                                $_SESSION['totalAMT'] = $amtt;

                                header("Location: bill.php");
                            }
                            ?>
                        <?php } ?>
                    </center>
                </div>
                <hr />
                <div class="wrap-input100 validate-input">
                    <a href="collector_cart.php">Back</a>
                </div>
                <hr />
                <br />

                <!--                        <div class="text-center p-t-12">
                                            <br>
                                            <a class="txt2" href="customersubcategory.php" class="txt2"><h6>Back</h6></a>
                                        </div>-->
            </center>

        </form>
    </center>
    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js" type="text/javascript"></script>
    <!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js" type="text/javascript"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js" type="text/javascript"></script>
    <?php ob_flush(); ?>
</body>

</html>