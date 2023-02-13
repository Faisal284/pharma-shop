<?php
session_start();
include "includes/mysqli_connect.php";
include "includes/source.php";
include "includes/header.php";
?>
    <section>
        <div class="container py-85 py-tn-50" style="margin-top: 100px">
            <div class="port-title">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 text-center">
                            <h2 class="title">اتصل بنا
</h2>
                            <p class="title-detail">إذا كنت بحاجة إلى نصيحة بشأن المنتج  . يرجى الاتصال بنا عن طريق ملء المعلومات أدناه. شكرا جزيلا!
</p>
                            <div class="title-border mx-auto m-b-55 m-b-tn-35"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="port-body">
                <div class="contact-form">
                    <div class="messages" id="status"></div>
                    <form id="contact-form" method="post" action="action_contact.php">
                        <div class="row">
                         
                            <div class="col-md-6">
                                <div class="form-group au-form">
                                    <div class="help-block with-errors"></div>
                                    <input type="email" id="email" name="email" placeholder="البريد الالكترونى *" required="" data-error="Please, enter a valid email.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group au-form">
                                    <div class="help-block with-errors"></div>
                                    <input type="text" id="name" name="name" placeholder="الاسم كامل *" required="" data-error="Name is required.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group au-form">
                                    <div class="help-block with-errors"></div>
                                    <input type="text" id="address" name="address" placeholder="العنوان الخاص بك ( اختياري) " required="" data-error="Address is required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group au-form">
                                    <div class="help-block with-errors"></div>
                                    <input type="text" id="phone" name="phone" placeholder="رقم الهاتف *" required="" data-error="Phone is required">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group au-form">
                                    <div class="help-block with-errors"></div>
                                    <textarea rows="9" placeholder="محتوى الرسالة " id="msg" name="msg" required="" data-error="Please, leave us a message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group au-form">
                                    <button type="submit" id="contactBtn" class="mx-auto">أرسل رسالتك </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php
include "includes/footer.php";

?>