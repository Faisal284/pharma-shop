<?php
session_start();

include "includes/mysqli_connect.php";

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/OAuth.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/POP3.php";
require "PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$msg= '';

$arrKey = array_keys($_SESSION['cart']);
$strKey = implode(",",$arrKey);
$q = "SELECT * from products where product_id in($strKey)";
$r = mysqli_query($dbc, $q);


//Gui Mail
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();
    if (!empty($_POST['name'])){
        $name = $_POST['name'];
    }else{
        $errors[] = "من فضلك ادخل الاسم";
    }
    if (!empty($_POST['phone'])){
        $phone = $_POST['phone'];
    }else{
        $errors[] = "من فضلك ادخل الايميل";
    }if (!empty($_POST['email'])){
        $email = $_POST['email'];
    }else{
        $errors[] = "من فضلك ادخل العنوان";
    }
    if (!empty($_POST['address'])){
        $address = $_POST['address'];
    }else{
        $errors[] = "ادخل عنوان الشحن";
    }
    $add_notice = $_POST['add_notice'];

    if (empty($errors)) {
        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();                                          
            $mail->Host = 'smtp.gmail.com';                    
            $mail->SMTPAuth = true;                        
            $mail->Username = 'drsteve2030@gmail.com';           
            $mail->Password = 'midocom@2020';                           
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       
            $mail->Port = 587;                                    
            $mail->CharSet = 'UTF-8';
            //Recipients
            $mail->setFrom('drsteve2030@gmail.com','PHARMATEAM'); 
            $mail->addAddress($email, 'Customer');     


            
            $mailHTML = '';
            $mailHTML .= '
                    <p>
                        <b>Full Name:</b> ' . $name . '<br>
                        <b>Phone number:</b> ' . $phone . '<br>
                        <b>Delivery address:</b> ' . $address . '<br>
                        <b>Additional information:</b> ' . $add_notice . '<br>
                        <b>Delivery charges:</b><span> 30.0 EG</span><br>
                    </p>


                    <table border="1" cellspacing="0" cellpadding="10" bordercolor="#305eb3" width="100%">
                        <tr bgcolor="#5e5e5e">
                            <td width="70%"><b>
                                    <font color="white">المنتجات</font>
                                </b></td>
                            <td width="10%"><b>
                                    <font color="white">القيمة</font>
                                </b></td>
                            <td width="20%"><b>
                                    <font color="white">الإجمالى</font>
                                </b></td>
                        </tr>';

            $Tongcong = 4;
            $code = rand(100000,1000000);
            while ($sendmail = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                $Thanhtien = $_SESSION['cart'][$sendmail['product_id']]['quantity'] * $sendmail['selling_price'];

                $mailHTML .= '
                        <tr>
                            <td width="70%">' . $sendmail['product_name'] . '</td>
                            <td width="10%">' . $_SESSION['cart'][$sendmail['product_id']]['quantity'] . '</td>
                            <td width="20%">' . number_format($Thanhtien, 0, ',', '.') . "<span'> INR</span>" . '</td>
                        </tr>';
                $Tongcong += $Thanhtien;
                $q1 = "INSERT INTO transactions (transaction_code,customer_name,customer_email,customer_phone,customer_address,product,quantity,subtotal,time_order) ";
                 $q1 .=" VALUE ($code,'{$name}','{$email}','{$phone}','{$address}','{$sendmail['product_name']}','{$_SESSION['cart'][$sendmail['product_id']]['quantity']}',$Thanhtien,NOW())";
                 $r1 = mysqli_query($dbc,$q1);

            }
            $Tongcong += 30000;
            $mailHTML .= '
                                <tr>
                                    <td colspan="2" width="70%"></td>
                                    <td width="20%"><b>
                                            <font color="red">' . number_format($Tongcong, 0, ',', '.') . "<span style='color: red'> INR</span>" . '</font>
                                        </b></td>
                                </tr>
                            </table>




                            <p>
                            شكرا لثقتكم وشرائكم! سنحاول شحن طلبك في أقرب وقت ممكن.
                            </p>';
            // Content
            $mail->isHTML(true);                                  
            $mail->Subject = 'Bill';
            $mail->Body = $mailHTML;

            $mail->send();
            
            unset($_SESSION['cart']);
            header('Location:success.php', true, 302);
        } catch (Exception $e) {
            echo "خطأ! لم يتم إرسال البريد بسبب خطأ
            : {$mail->ErrorInfo}";
        }
    }else {
        foreach ($errors as $error){
            $msg .= $error . "<br/>";
            header('Location: checkout.php?msg='.$msg.'');
        }
    }
}
