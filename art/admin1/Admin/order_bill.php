<?php
// Start session
session_start();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$server='localhost';
$username='root';
$password='';
$database='art';

$conn = mysqli_connect($server,$username,$password,$database);

if(!$conn)
{
    echo "Opps...Something Went Wrong In Connection";
}
else
{
   // echo "Very_Guud...";
}


// SQL query with prepared statement
$sel = "SELECT * 
        FROM tbl_shoporder shoporder
        INNER JOIN tbl_cart cart ON shoporder.cart_id = cart.cart_id
        INNER JOIN tbl_customer customer ON cart.customer_id = customer.customer_id
        INNER JOIN tbl_shop shop ON cart.shop_id = shop.shop_id
        INNER JOIN tbl_artist artist ON shop.artist_id = artist.artist_id
        WHERE shoporder.shoporder_id = ?";

// Prepare the statement
$stmt = mysqli_prepare($conn, $sel);

// Bind the $order_code parameter to the prepared statement
mysqli_stmt_bind_param($stmt, 's', $order_code);

// Execute the prepared statement
mysqli_stmt_execute($stmt);

// Get the result
$res = mysqli_stmt_get_result($stmt);

// Check if a row was fetched
if ($res && mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_array($res);
} else {
    // Handle error if no rows found
    echo "No order found or error: " . mysqli_error($conn);
    exit; // Stop further execution
}

// Close the statement
mysqli_stmt_close($stmt);

// Assigning values to variables
$shoporder_id = $row['shoporder_id'];
$customer_id = $row['customer_id'];
$arttitle = $row['arttitle'];
$email = $row['customer_emailid'];
$country = $row['shop_country'];
$state = $row['shop_state'];
$city = $row['shop_city'];
$zipcode = $row['shop_zipcode'];
$date = $row['shop_date'];
$time = $row['shop_time'];
$qty = $row['qty'];
$price = $row['price'] + $row['shipcost'];
$amount = $row['shop_amount'];

// Store generated HTML in the session variable 'bill'
$_SESSION['bill'] = "
    <center>
        <h1 style='color:#755588'>Vision Arts</h1>
        <hr/>
    </center>
    <center>
        <table style='border:solid 1px;'>
            <tr style='border:solid 1px;'>
                <td style='padding: 5px;border:solid 1px;font-weight: bold;'>Order Id:</td>
                <td style='padding: 5px;border:solid 1px;'>$shoporder_id</td>
                <td style='padding: 5px;border:solid 1px;font-weight: bold;'>Customer Id:</td>
                <td style='padding: 5px;border:solid 1px;'>$customer_id</td>
            </tr>
            <tr style='border:solid 1px;'>
                <td style='padding: 5px;border:solid 1px;font-weight: bold;'>Artwork:</td>
                <td style='padding: 5px;border:solid 1px;'>$arttitle</td>
                <td style='padding: 5px;border:solid 1px;font-weight: bold;'>Email Id:</td>
                <td style='padding: 5px;border:solid 1px;'>$email</td>
            </tr>
            <tr style='border:solid 1px;'>
                <td style='padding: 5px;border:solid 1px;font-weight: bold;'>Country:</td>
                <td style='padding: 5px;border:solid 1px;'>$country</td>
                <td style='padding: 5px;border:solid 1px;font-weight: bold;'>State:</td>
                <td style='padding: 5px;border:solid 1px;'>$state</td>
            </tr>
            <tr style='border:solid 1px;'>
                <td style='padding: 5px;border:solid 1px;font-weight: bold;'>City:</td>
                <td style='padding: 5px;border:solid 1px;'>$city</td>
                <td style='padding: 5px;border:solid 1px;font-weight: bold;'>Zip Code:</td>
                <td style='padding: 5px;border:solid 1px;'>$zipcode</td>
            </tr>
            <tr style='border:solid 1px;'>
                <td style='padding: 5px;border:solid 1px;font-weight: bold;'>Date:</td>
                <td style='padding: 5px;border:solid 1px;'>$date</td>
                <td style='padding: 5px;border:solid 1px;font-weight: bold;'>Time:</td>
                <td style='padding: 5px;border:solid 1px;'>$time</td>
            </tr>
            <tr style='border:solid 1px;'>
                <td style='padding: 5px;border:solid 1px;font-weight: bold;'>Quantity:</td>
                <td style='padding: 5px;border:solid 1px;'>$qty</td>
                <td style='padding: 5px;border:solid 1px;font-weight: bold;'>Price:</td>
                <td style='padding: 5px;border:solid 1px;'>$price</td>
            </tr>
            <tr style='border:solid 1px;'>
                <td style='padding: 5px;align-text:center;font-weight: bold;'></td>                 
                <td style='padding: 5px;align-text:center;font-weight: bold;'></td>                 
                <td style='padding: 5px;align-text:center;font-weight: bold;font-size:20px;'>Total Amount:</td>
                <td style='padding: 5px;align-text:center;font-weight: bold;font-size:18px;'>$amount</td>
            </tr>
        </table>
        <hr/>
    </center>";
?>
<html>
<head>
    <title>Invoice</title>
</head>
<body>
    <?php 
    // Uncommented HTML here for better organization
    echo $_SESSION['bill']; 
    ?>
</body>
</html>
