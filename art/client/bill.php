<?php
include("../connection.php");
ob_start();
session_start();

if (empty($_SESSION['signin_username'])) {
    header("Location: signin.php");
}

if (isset($_REQUEST['cp_code'])) {
    $cp_code = $_REQUEST['cp_code'];
}

$email = $_SESSION['payemail'];
$fname = $_SESSION['payufirstname'];
$lname = $_SESSION['payutxt_lastname'];
$amt = $_SESSION['payuamount'];
$contact = $_SESSION['payuphone'];
$add = $_SESSION['payustreetaddress'];
$city = $_SESSION['payucity'];
$state = $_SESSION['payustate'];
$country = $_SESSION['payucountry'];
$zipcode = $_SESSION['payuzipcode'];
$amtt = $_SESSION["totalAMT"];
$shipcost = $_SESSION["shipcost"];

$q = "SELECT * FROM tbl_cart c, tbl_shop s, tbl_artist a WHERE c.shop_id = s.shop_id AND s.artist_id = a.artist_id AND cart_status = 0;";
$res = mysqli_query($conn, $q);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <link rel="shortcut icon" type="image/x-icon" href="Images/Artboard 1.png">
    <link href="https://fonts.googleapis.com/css?family=Gilda+Display%7CMontserrat:400,700%7COpen+Sans" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/template.css" rel="stylesheet" type="text/css">

    <title>Bill Details with GST</title>

    <!-- Inline CSS (as provided in the previous version) -->
    <style>
        * {
            border: 0;
            box-sizing: content-box;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            line-height: inherit;
            list-style: none;
            margin: 0;
            padding: 0;
            text-decoration: none;
            vertical-align: top;
        }

        table {
            font-size: 75%;
            table-layout: fixed;
            width: 100%;
            border-collapse: separate;
            border-spacing: 2px;
        }

        th, td {
            border-width: 1px;
            padding: 0.5em;
            position: relative;
            text-align: left;
            border-radius: 0.25em;
            border-style: solid;
        }

        th {
            background: #EEE;
            border-color: #BBB;
        }

        td {
            border-color: #DDD;
        }

        html {
            font: 16px/1 'Open Sans', sans-serif;
            overflow: auto;
            padding: 0.5in;
        }

        body {
            box-sizing: border-box;
            height: 11in;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;
            width: 8.5in;
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }

        header h2 {
            background: #000;
            border-radius: 0.25em;
            color: #FFF;
            margin: 0 6 1em;
            padding: 0.5em 5;
            text-align: center;
        }

        table.inventory th {
            font-weight: bold;
            text-align: center;
        }

        table.inventory td:nth-child(1) {
            width: 26%;
        }

        table.inventory td:nth-child(2),
        table.inventory td:nth-child(3),
        table.inventory td:nth-child(4),
        table.inventory td:nth-child(5),
        table.inventory td:nth-child(6) {
            text-align: center;
            width: 12%;
        }

        table.balance th, table.balance td {
            width: 50%;
        }

        table.balance td {
            text-align: right;
        }

        @media print {
            html {
                background: none;
                padding: 0;
            }

            body {
                box-shadow: none;
                margin: 0;
            }

            span:empty {
                display: none;
            }
        }

        @page {
            margin: 0;
        }
    </style>
</head>

<body>
    <header>
        <h2>Bill Detail</h2>
        <table>
            <tr>
                <th>Name:</th>
                <td><b><?php echo $fname . " " . $lname; ?></b></td>
            </tr>
            <tr>
                <th>Address:</th>
                <td><b><?php echo $add; ?></b></td>
            </tr>
            <tr>
                <th>Contact:</th>
                <td><b><?php echo $contact ?></b></td>
            </tr>
        </table>
    </header>

    <article>
        <table class="inventory">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Ship Cost</th>
                    <th>Rate</th>
                    <th>Quantity</th>
                    <th>GST (%)</th>
                    <th>GST Amount</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalWithGST = 0;
                $gstRate = 18; // GST rate as 18%
                while ($r = mysqli_fetch_assoc($res)) {
                    $itemTotal = ($r['price'] + $shipcost) * $r['qty'];
                    $gstAmount = ($itemTotal * $gstRate) / 100;
                    $totalPriceWithGST = $itemTotal + $gstAmount;
                    $totalWithGST += $totalPriceWithGST;
                ?>
                    <tr>
                        <td>
                            <h4><a href="#"><?php echo $r['arttitle']; ?></a></h4>
                            <h5>by <a href="#"><?php echo $r['artist_firstname'] . " " . $r['artist_lastname']; ?></a></h5>
                        </td>
                        <td><?php echo number_format($shipcost, 2); ?></td>
                        <td><?php echo number_format($r['price'], 2); ?></td>
                        <td><?php echo $r['qty']; ?></td>
                        <td><?php echo $gstRate; ?></td>
                        <td><?php echo number_format($gstAmount, 2); ?></td>
                        <td><?php echo number_format($totalPriceWithGST, 2); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <table class="balance">
            <tr>
                <th>Total (Including GST)</th>
                <td><?php echo number_format($totalWithGST, 2); ?> INR</td>
            </tr>
            <tr>
                <th>Amount Paid</th>
                <td><?php echo number_format($totalWithGST, 2); ?> INR</td>
            </tr>
        </table>
    </article>

    <center>
        <!-- Download PDF Button placed before Continue Shopping -->
        <button id="download-pdf" style="padding: 10px 20px; margin-top: 20px; cursor: pointer; font-size: 16px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;">
            Download PDF
        </button>

        <form action="#" method="post">
            <input type="submit" name="btnComplete" value="Continue Shopping" class="btn btn-primary" style="width: 30%; margin:20px; cursor: pointer;" />
            <?php
            if (isset($_POST['btnComplete'])) {
                $_SESSION["totalAMT"] = $totalWithGST;
                header("Location: collector_home.php");
            }
            ?>
        </form>
    </center>

    <script>
        document.getElementById("download-pdf").addEventListener("click", function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            // Get the bill content
            const billContent = document.body.innerHTML;

            // Add the bill content to PDF (with fixed positioning to maintain layout)
            doc.html(billContent, {
                callback: function (doc) {
                    // Save the generated PDF
                    doc.save('bill_details.pdf');
                },
                x: 10,
                y: 10
            });
        });
    </script>
    

</body>

</html>
