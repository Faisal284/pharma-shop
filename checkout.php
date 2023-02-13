<?php
session_start();

include "includes/mysqli_connect.php";
include "includes/source.php";
include "includes/header.php";

if (isset($_GET['msg'])){
    $msg = $_GET['msg'];
}else{
    $msg= '';
}

$cust_id = $_SESSION['cust_id'];
$name= $_SESSION['cust_name'];
$mobile= $_SESSION['cust_mobile'];
$email=$_SESSION['cust_email'];
$password = $_SESSION['cust_password'];
$address = $_SESSION['cust_address'];

$arrKey = array_keys($_SESSION['cart']);
$strKey = implode(",",$arrKey);
$q = "SELECT * from products where product_id in($strKey)";
$r = mysqli_query($dbc, $q);



?>
    <section>
        <div class="pageintro">
            <div class="pageintro-bg">
                <img src="style\images\bg-page_02.jpeg" alt="About Us">
            </div>
            <div class="pageintro-body">
                <h1 class="pageintro-title">تأكيد عملية الشراء</h1>
                <nav class="pageintro-breadcumb">
                </nav>
            </div>
        </div>
    </section>
    <section>
        <div class="container p-t-100 p-b-45">
            <?php
                if (!empty($msg)){
                    echo "
                        <div class=\"card card-inverse-warning\" id=\"context-menu-access\">
                            <div class=\"card-body\">
                              <p class=\"card-text\" style='text-align: center;color: red'>{$msg}</p>
                            </div>
                        </div>";
                }
            ?>
            <div class="row" dir="rtl">
                <div class="col-md-6">
                    <div class="au-form-body p-b-0">
                        <h2 style="float:right" class="au-form-title form-title-border m-b-37">معلومات العميل</h2>
                        <br><br><br><br>
                        <form enctype="multipart/form-data" method="post" action="action_checkout.php" dir="rtl">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group au-form require">
                                        <label style="text-align: center;" dir="rtl">اسم العميل بالكامل
</label>
                                        <input type="text" name="name" value="<?php echo $name;?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group au-form require">
                                        <label style="text-align: center;">رقم التليفون</label>
                                        <input type="number" name="phone"  value="<?php echo $mobile;?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group au-form">
                                        <label style="text-align: center;">البريد الالكترونى</label>
                                        <input type="text" name="email" value="<?php echo $email;?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group au-form require">
                                        <label style="text-align: center;" >عنوان التوصيل</label>
                                        <input type="text" name="address" value="<?php echo $address;?>">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="au-form-body">
                        <h2 class="au-form-title form-title-border m-b-37" style="text-align: center;" >معلومة اضافية
</h2>
                            <div class="form-group au-form">
                                <label style="float: right">ملاحظات الطلب (اختياري)
</label><br><br>
                                <textarea cols="70" rows="9" name="add_notice" style="color: black;border: 1px solid #e5e5e5;font-size: 13px;padding: 10px 20px;" placeholder=" "></textarea>
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="au-form-body">
                        <h2 style="float:right" class="au-form-title form-title-border m-b-37">طلبك
</h2>
                        <table class="table table-striped" style="text-align: center;" class="checkout-bill" dir="rtl">
                            <tbody>
                            <tr>
                                <th>المنتج</th>
                                <th>التكلفة</th>
                            </tr>
                            <?php
                            $total = 0;
                            while ($rows = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
                                $subtotal = $_SESSION['cart'][$rows['product_id']]['quantity'] * $rows['selling_price'];
                                ?>
                                <tr>
                                    <td><?php echo $rows['product_name']." <span style='color: red'>x".$_SESSION['cart'][$rows['product_id']]['quantity']."</span>"; ?></td>
                                    <td><?php echo number_format($subtotal, 0, ',', '.')."<span style='color: red'>جنيه مصرى</span>";?></td>
                                </tr>

                                <?php
                            $total = $total + $subtotal;
                            }
                                ?>
                            <?php $total+=30000; ?>
                            <tr>
                                <td>رسوم التوصيل
</td>
                                <td>30.000<span style="color:red;">جنيه مصرى</span></td>
                            </tr>
                            <tr class="total">
                                <td>الأجمالى</td>
                                <td><?php echo number_format($total, 0, ',', '.')."<span style='color: red'>جنيه مصرى</span>";?></td>
                            </tr>
                            </tbody>
                        </table>
                            <input type="submit" name="submit" class="process-button m-t-50 float-right" value="إطلب الآن">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php
include "includes/footer.php";

?>