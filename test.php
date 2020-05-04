<?php
include_once 'header.php';
?>

<?php
if(!isset($username) || preg_match("/([^0-9a-z-]+)/", $username)){
    header("Location: http://daftarna.net");
    exit();
}
$id = $username;

$us = $db->qex("SELECT * FROM users WHERE username = '$id'");
if($us->num_rows == 0) {
    header("Location: http://daftarna.net");
    exit();
}

$info = $us->fetch_object();
?>

<div class="ad">
    <span><?php echo ads("ads24"); ?></span>
</div>

<!-- account panel -->
<div class="account-panel account-message">
    <div class="container">
        <div class="clearfix">
            <div class="account-content col-sm-10">

                <?php
                $f = true;
                if($info->tp == 1){

                    $errors = array();
                    $up=new up();
                    $up->mime=array('image/png','image/x-png','image/pjpeg','image/jpg','image/jpeg','application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/msword'); // mime types
                    $up->ext=array('png','jpg','jpeg'); // extention allowed
                    $up->up_folder=('msgs_img'); // dir to upload
                    $up->upl=(__DIR__.'/'.$up->up_folder); // dont edit this
                    $up->file_name = 'file'; // name of file upload
                    $up->max_size="2560000"; // 2 Mb
                    if(!is_dir($up->upl)){
                        exit(" مجلد الرفع ".$up->upl." غير موجود");
                    }
                    if(!is_writable($up->upl)){
                        exit(" مجلد الرفع ".$up->upl." غير قابل للكتابة الرجاء إعطاءه التصريح 777");
                    }

                    if(isset($_POST['s'])) {

                        $msg = preg_replace( "/\r\n/", " ", $_POST['msg'] );
                        $msg = $db->fil($msg, "trim|xss_clean");

                        $file = "";
                        if(!empty($_FILES['file']['name'])){

                            $isup=$up->upload();
                            if($isup === TRUE){
                                $file = $up->url;
                            }else {
                                $errors['img'] = $isup;
                            }

                        }
                        if(empty($msg) || mb_strlen($msg) > 1000 )
                        {
                            $errors['msg'] = "الرجاء إدخال رسالة اقل من 1000 حرف ";
                        }
                        if(isset($_POST['an']))
                        {
                            $name = "مجهول";
                        }else {
                            $name = $db->fil($_POST['name'], "trim|xss_clean");
                        }
                        if(mb_strlen($name) > 50) {
                            $errors['msg'] = "لا يمكن إدخال اسم اكثر من 18 حرف ";
                        }


                        if(count($errors) == 0)
                        {
                            $idate = time();
                            $msg = htmlspecialchars($msg);
                            $user = $info->id;
                            if(isset($_POST['recaptcha_response'])){
                                // recaptcha_response
                                // Build POST request:
                                $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
                                $recaptcha_secret = '6LdJtu8UAAAAALitI6bah_Vk0W5Bc3ZrBRt-yS8p';
                                $recaptcha_response = $_POST['recaptcha_response'];

                                // Make and decode POST request:
                                $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
                                $recaptcha = json_decode($recaptcha);

                                // Take action based on the score returned:
                                if ($recaptcha->score >= 0.5) {
                                    $in = $db->qex("INSERT INTO books(user, name, msg, img, date) VALUES ('$user','$name','$msg','$file','$idate')");
                                    if($in) {
                                        $f = false;
                                        header("Location: http://daftarna.net/thanks");
                                        exit();
                                    }
                                } else {
                                    echo "<div class='alert alert-danger' style='text-align: right;'><p>لم نتحقق من بشريتك</p>1</div>";
                                }

                                // end recaptcha_response

                            }else{
                                echo "<div class='alert alert-danger' style='text-align: right;'><p>لم نتحقق من بشريتك</p>2</div>";
                            }
                        }else {
                            echo "<div class='alert alert-danger' style='text-align: right;'><p>الرجاء تصحيح الاخطاء التالية : </p><ul class='signup_errors'>";
                            foreach ($errors as $key) {
                                echo "<li>".$key."</li>";
                            }
                            echo "</ul></div>";
                        }
                    }
                    ?>
                    <?php if($f){ ?>
                        <div class="account-image">
                            <img src="user_img/<?php echo $info->img; ?>" class="wh80">
                            <p class="h3"><?php echo $info->fname, " ", $info->lname; ?> <br>  <?php echo $info->univercity ; ?> - <?php echo $info->fac; ?> </p>
                        </div>


                        <form method="post" action="" class="clearfix" enctype="multipart/form-data">
                            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">


                            <div class="message-form">
                                <textarea class="form-control" name="msg" placeholder="اكتب رسالتك هنا يفضل بدون ايموجي ثم ارفقها بصورة ..." maxlength="1000" required></textarea>
                            </div>
                            <div class="msg-inputs clearfix">
                                <div class="message-opts">
                                    <div class="msg-name">
                                        <label>
                                            <input type="text" name="name" placeholder="اكتب اسمك هنا ..." class="name_an" maxlength="18" required>
                                            <p>
                                                <input type="checkbox" name="an" value="1" class="cl_ch">
                                                <span>اجعل رسالتي من مجهول</span>
                                            </p>
                                        </label>
                                    </div>
                                    <div class="msg-img">
                                        <img src="img/add-img.png">
                                        <p>ارفق صورة</p>
                                        <input type="file" class="input_f" name="file">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="message-btn">
                                    <button type="submit" class="btn btn-default" name="s"><img src="img/send-msg.png">ارسل</button>
                                </div>
                            </div>
                        </form>
                    <?php }else { if(!isset($_SESSION['login'])){ ?>

                        <div>

                            <h3 class="message">
                                لا تمتلك دفتر تخرج ?
                            </h3>
                            <a href="signup" class="btn btn-default">سجّل الان</a>
                            <br>
                            <br>
                            <!--  <script src="https://sbhc.portalhc.com/147642/searchbox/462573"></script> -->

                        </div>

                    <?php }
                    h} ?>

                <?php }else { ?>
                    <div class="alert alert-danger">هذا الحساب معلق لا يمكن ترك رسالة له .</div>
                <?php } ?>
            </div>
            <div class="side-ad col-sm-2">
                <span class="ad-text"><?php echo ads("ads14"); ?></span>
            </div>
        </div>
    </div>
</div>


<?php
include_once 'footer.php';
?>
