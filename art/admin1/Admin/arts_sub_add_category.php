<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location:login.php");
}
include('link.php');
include('top_header.php');
//include('left_menu.php');
include('../connection.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Sub Category</title>
    <?php include('link.php') ?>
</head>

<body>
    <div class="span9" id="content" style="margin-left: 10em;">
        <!-- morris stacked chart -->
        <div class="row-fluid">
            <!-- block -->
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">Add Category</div>
                </div>
                <div class="block-content collapse in">
                    <div class="span12">
                        <form action="#" class="form-horizontal" method="post">
                            <fieldset>


                                <!--                                    <div class="alert alert-success">
                                        <button class="close" data-dismiss="alert"></button>

                                    </div>-->

                                <!--<div class="alert alert-success hide">
                                            <button class="close" data-dismiss="alert"></button>
                                            Your form validation is successful!
                                    </div>-->
                                <div class="control-group">
                                    <label class="control-label">Main Category<span class="required">*</span></label>
                                    <div class="controls">
                                        <select name="mc">
                                            <?php
                                            $q = $conn->query("Select * from tbl_category;");
                                            while ($k = $q->fetch_row()) {
                                                echo "<option value='$k[0]'>$k[1]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div><br />
                                    <label class="control-label">Category Name<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="txtAddSubCategory" data-required="1" class="span6 m-wrap" required />
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" onclick="myFunction()" name="btnAdd" class="btn btn-primary">Add</button>
                                    <?php
                                    if (isset($_POST['btnAdd'])) {
                                        $id = $_POST['mc'];
                                        $sn = $_POST['txtAddSubCategory'];
                                        $a = "active";

                                        $u = "SELECT * FROM tbl_subcategory WHERE category_id='" . $id . "' && subcategory_name='" . $sn . "' ";
                                        $v = mysqli_query($conn, $u);
                                        $counttt = mysqli_fetch_row($v);
                                        if ($counttt > 0) {
                                            echo "<script type=\"text/javascript\">window.alert('Sub-Category Already Exists!');window.location.href = 'arts_sub_add_category.php';</script>";
                                        } else {
                                                $q1 = $conn->prepare("insert into tbl_subcategory (subcategory_name,category_id,subcategory_status) values(?,?,?)");
                                                $q1->bind_param("sis", $sn, $id, $a);
                                                $q1->execute();
                                                echo "<script>swal('Done.!', 'Sub-Category Added  Successfully.!', 'success');</script>";
                                            
                                        }
                                    }
                                    ?>
                                    <button type="reset" class="btn">Cancel</button>
                                </div>
                            </fieldset>
                        </form>


                    </div>
                </div>
            </div>


            <?php
            include('footer.php');
            include('js_link.php');
            ?>

</body>

</html>