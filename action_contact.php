<?php
session_start();

include "includes/mysqli_connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();
    if (!empty($_POST['name'])){
        $name = $_POST['name'];
    }else{
        $errors[] = "Please enter your full name!";
    }
    if (!empty($_POST['phone'])){
        $phone = $_POST['phone'];
    }else{
        $errors[] = "Please enter your phone number!";
    }if (!empty($_POST['email'])){
        $email = $_POST['email'];
    }else{
        $errors[] = "Please enter your email address!";
    }
    if (!empty($_POST['address'])){
        $address = $_POST['address'];
    }
    else{
        $address="";
        // $errors[] = "Please enter address for you!";
    }
    $content = $_POST['msg'];

    if (empty($errors)) {
        
                $q1 = "INSERT INTO inquiry_master (customer_name,customer_email,customer_phone,customer_address,content) ";
                $q1 .=" VALUE ('{$name}','{$email}','{$phone}','{$address}','{$content}')";
                $r1 = mysqli_query($dbc,$q1);
                header('Location: contact.php');
    }else {
        foreach ($errors as $error){
            $msg .= $error . "<br/>";
            header('Location: contact.php?msg='.$msg.'');
        }
    }
}
