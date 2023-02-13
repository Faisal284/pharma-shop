<?php
include ('includes/mysqli_connect.php');
include ('includes/functions.php');
$msg= '';
$suc= '';
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $errors = array();
    if (!empty($_POST['name'])){
        $name = mysqli_real_escape_string($dbc,$_POST['name']);
    }else{
        $errors[] = 'من فضلك أدخل اسمك ';
    }
    if (!empty($_POST['mobile'])){
        $mobile = mysqli_real_escape_string($dbc,$_POST['mobile']);
    }else{
        $errors[] = 'من فضلك أدخل الموبايل';
    }
    if (isset($_POST['account']) && filter_var($_POST['account'],FILTER_VALIDATE_EMAIL)){
        $account = mysqli_real_escape_string($dbc,$_POST['account']);
    }else{
        $errors[] = 'من فضلك أدخل البريد الإلكترونى';
    }
    if (isset($_POST['password']) && preg_match('/^[\w\'.-]{6,20}$/',$_POST['password'])){
        $password = mysqli_real_escape_string($dbc,$_POST['password']);
    }else{
        $errors[] = 'يرجى إدخال كلمة المرور التي تتكون من 6-20 حرفًا
        ';
    }
    if (!empty($_POST['name'])){
        $address = mysqli_real_escape_string($dbc,$_POST['address']);
    }else{
        $errors[] = 'الرجاء إدخال عنوانك
        ';
    }

    if (empty($errors)){
        $q = "SELECT email FROM customer WHERE email = '{$account}'";
        
        $r = mysqli_query($dbc,$q);
        if (mysqli_num_rows($r) >= 1){
            $msg = "Email account already exists !! Please register another account!";
            $suc = 0;
            header('Location: register.php?msg='.$msg);
        }else{
            $q = "INSERT INTO customer (name,email,mobile,password,address) VALUE ('$name','$account','$mobile',SHA1('$password'), '$address')";
         
            $r = mysqli_query($dbc,$q);
            confirm_query($r,$q);

            if (mysqli_affected_rows($dbc) == 1){
                header('Location: index.php');
            }else{
                $msg = "System error";
                $suc = 0;
            }
        }
    }else{
        foreach ($errors as $error){
            $msg .=$error."<br/>";
            header('Location: register.php?msg='.$msg);
        }
    }
}
?>