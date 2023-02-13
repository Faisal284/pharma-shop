<?php
include('includes/mysqli_connect.php');
include('includes/functions.php');
$msg = '';
$suc = '';
$cust_id = $_GET["id"];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();
    if (!empty($_POST['name'])) {
        $name = mysqli_real_escape_string($dbc, $_POST['name']);
    } else {
        $errors[] = 'من فضلك ادخل الاسم كامل';
    }
    if (!empty($_POST['mobile'])) {
        $mobile = mysqli_real_escape_string($dbc, $_POST['mobile']);
    } else {
        $errors[] = 'من فضلك ادخل الموبايل';
    }
    if (isset($_POST['account']) && filter_var($_POST['account'], FILTER_VALIDATE_EMAIL)) {
        $account = mysqli_real_escape_string($dbc, $_POST['account']);
    } else {
        $errors[] = 'من فضلك ادخل البريد الالكترونى';
    }
    if (isset($_POST['password']) && preg_match('/^[\w\'.-]{6,20}$/', $_POST['password'])) {
        $password = mysqli_real_escape_string($dbc, $_POST['password']);
    } else {
        $errors[] = 'من فضلك ادخل كلمة السر';
    }
    if (!empty($_POST['name'])) {
        $address = mysqli_real_escape_string($dbc, $_POST['address']);
    } else {
        $errors[] = 'من فضلك ادخل العنوان';
    }

    if (empty($errors)) {

        $q = "UPDATE customer SET name = '$name', mobile='$mobile', email = '$account', password = SHA1('$password'), address = '$address' WHERE cust_id='$cust_id'";

        session_start();
        $_SESSION['is_user_login'] = true;
        $_SESSION['cust_id'] = $cust_id;
        $_SESSION['cust_name'] = $name;
        $_SESSION['cust_mobile'] = $mobile;
        $_SESSION['cust_email'] = $account;
        $_SESSION['cust_password'] = $password;
        $_SESSION['cust_address'] = $address;

        $r = mysqli_query($dbc, $q);
        confirm_query($r, $q);

        if (mysqli_affected_rows($dbc) == 1) {
            header('Location: index.php');
        } else {
            header('Location: account.php?msg=' . "لا يوجد تعديلات.");
        }
    } else {
        foreach ($errors as $error) {
            $msg .= $error . "<br/>";
            header('Location: account.php?msg=' . $msg);
        }
    }
}
