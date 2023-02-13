<?php
session_start();
$_SESSION['is_user_login'] = false;
$_SESSION['cust_id'] = '';
$_SESSION['cust_name'] = '';
$_SESSION['cust_email'] = '';
$_SESSION['cust_password'] = '';
$_SESSION['cust_address'] = '';
session_destroy();

header('Location: index.php');
?>