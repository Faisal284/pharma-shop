<?php
session_start();
?>
<?php
include ('includes/mysqli_connect.php');
include ('includes/functions.php');
$msg= '';
$suc= '';
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $errors = array();
    if (isset($_POST['account']) && filter_var($_POST['account'],FILTER_VALIDATE_EMAIL)){
        $account = mysqli_real_escape_string($dbc,$_POST['account']);
    }else{
        $errors[] = 'من فضلك ادخل البريد الالكترونى';
    }
    if (isset($_POST['password']) && preg_match('/^[\w\'.-]{6,20}$/',$_POST['password'])){
        $password = mysqli_real_escape_string($dbc,$_POST['password']);
    }else{
        $errors[] = 'من فضلك أدخل كلمة السر';
    }
    if (empty($errors)){
        $q = " SELECT cust_id,name,mobile,email,password,address FROM customer WHERE (email = '$account' AND password = SHA1('$password'))";
        $r = mysqli_query($dbc,$q);
        confirm_query($r,$q);

        if (mysqli_num_rows($r) == 1){
            list($id,$name,$mobile,$account,$pass,$address) = mysqli_fetch_array($r,MYSQLI_NUM);
            $_SESSION['is_user_login'] = true;
            $_SESSION['cust_id'] = $id;
            $_SESSION['cust_name'] = $name;
            $_SESSION['cust_mobile'] = $mobile;
            $_SESSION['cust_email'] = $account;
            $_SESSION['cust_password'] = $password;
            $_SESSION['cust_address'] = $address;
            $suc = 1;
        }else{
            $msg = "The account or password is incorrect.";
            $suc = 0;
        }
    }else{
        foreach ($errors as $error){
            $msg .=$error."<br/>";
        }
    }
    if ($suc == 1){
        // $q = "SELECT * FROM users JOIN roles USING (role_id) WHERE user_account = '{$account}' AND permission LIKE '%login%'";
        // $r = mysqli_query($dbc,$q);
        // if (mysqli_num_rows($r) >= 1){
            header('Location: index.php');
        // }else{
        //     header('Location: ../index.php');
        // }

    }else{

        header('Location: login.php?msg='.$msg);
    }
}
?>