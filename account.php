<?php
session_start();

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}
$cust_id = $_SESSION['cust_id'];
$name= $_SESSION['cust_name'];
$mobile = $_SESSION['cust_mobile'];
$email=$_SESSION['cust_email'];
$password = $_SESSION['cust_password'];
$address = $_SESSION['cust_address'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>حسابى</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="admin/vendors/css/vendor.bundle.base.css" />
    <link rel="stylesheet" href="admin/vendors/css/vendor.bundle.addons.css" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="admin/css/vertical-layout-light/style.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="admin/images/favicon.png" />
</head>

<body dir="rtl">
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <?php
                            if (!empty($msg)) {
                                echo "
                                    <div class=\"card card-inverse-warning\" id=\"context-menu-access\">
                                        <div class=\"card-body\">
                                          <p class=\"card-text\" style='text-align: center;'>{$msg}</p>
                                        </div>
                                    </div>";
                            }
                            ?>
                            <!-- <div class="brand-logo">
                                <img src="style/images/icon/logo_01.png" alt="logo" />
                            </div> -->
                            <h4>تفاصيل الحساب
</h4>
                            <form style="    float: right;     font-family: cairo;

" class="pt-3" action="action_update.php?id=<?php echo $cust_id;?>" method="post">
                                <div class="form-group">
                                    <label>الاسم كامل</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-account-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="name" value="<?php echo $name;?>" class="form-control form-control-lg border-left-0" placeholder="Full Name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>رقم الموبايل</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-cellphone-android text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="mobile" value="<?php echo $mobile;?>" class="form-control form-control-lg border-left-0" placeholder="Mobile Number" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>البريد الإلكترونى</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-email-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="email" name="account" value="<?php echo $email;?>" class="form-control form-control-lg border-left-0" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>كلمة السر</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-lock-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" value="<?php echo $password;?>" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>العنوان</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-map-marker text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="address" value="<?php echo $address;?>" class="form-control form-control-lg border-left-0" placeholder="Address" />
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="تحديث البيانات">
                                </div>
                                <div class="mt-3">
                                    <a href = "logout.php" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">تسجيل الخروج</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 register-half-bg d-flex flex-row">
                     </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>