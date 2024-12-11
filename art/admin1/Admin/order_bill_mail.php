<?php
// Include the database connection
include '../connection.php';

// Start session
session_start();

// Check if the user is logged in
if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Check if 'order_code' and 'customer' parameters are set in GET request
if (!isset($_GET['order_code']) || !isset($_GET['customer'])) {
    echo "Order code or customer information missing!";
    exit;
}

$order_code = $_GET['order_code'];
$customer_email = $_GET['customer'];

// Sanitize the inputs to avoid SQL injection (you can also use prepared statements)
$order_code = mysqli_real_escape_string($conn, $order_code);

// SQL query to fetch the order details
$sel = "SELECT * 
        FROM tbl_shoporder shoporder 
        INNER JOIN tbl_cart cart ON shoporder.cart_id = cart.cart_id
        INNER JOIN tbl_customer customer ON cart.customer_id = customer.customer_id
        INNER JOIN tbl_shop shop ON cart.shop_id = shop.shop_id
        INNER JOIN tbl_artist artist ON shop.artist_id = artist.artist_id
        WHERE shoporder.shoporder_id = '$order_code'";

$res = mysqli_query($conn, $sel);

// Check if a row is fetched
if ($res && mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_array($res);

    // Extracting customer details
    $customername = $row['customer_firstname'] . " " . $row['customer_lastname'];
    
    // Prepare the email content
    require 'mailerClass/PHPMailerAutoload.php';

    // Email subject and message
    $subject = "Purchase Bill";
    $message = "Dear $customername,<br/><br/>Your recent purchase from Vision Art Gallery has been dispatched and you will receive the purchase item soon."
        . "<br/><br/>This email message will serve as your receipt."
        . "<br/><br/>" . $_SESSION['bill']
        . "<br/><br/>The Vision Support Team<br/>"
        . "<a href='http://php.fun/art/client/visitor_home.php'>Visit Vision Art Gallery</a>";

    // Setup PHPMailer
    $mail = new PHPMailer();
    $mail->IsSmtp();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';  // Use SSL encryption

    // Optional: Disabling SSL verification (if needed)
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->Host = 'smtp.gmail.com';  // Gmail SMTP host
    $mail->Port = 465;               // SSL port for Gmail
    $mail->IsHTML(true);
    $mail->Username = "gopikalathiya091@gmail.com";  // Replace with your email
    $mail->Password = "lnqmivpjgqhtfiha";            // Replace with your app-specific password
    $mail->SetFrom("gopikalathiya091@gmail.com", "Vision Art Gallery");  // Sender email and name
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AddAddress($customer_email);  // Add recipient email

    // Send the email and check if successful
    if (!$mail->Send()) {
        echo "<span class='error'>Something went wrong: " . $mail->ErrorInfo . "</span>";
    } else {
        echo "<span class='success'>Message sent successfully!</span>";
        // Optionally, you can redirect or proceed with other actions
        // header("Location: order_dispatched.php");
    }

} else {
    echo "No order found for the given order code.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Email</title>
</head>
<body>
    <!-- You can display additional content or debugging information here -->
</body>
</html>
