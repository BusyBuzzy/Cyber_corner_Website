<?php require "template/header.php"; ?>
<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);


?>

<?php
    if (isset($_POST['regBtn'])) {

        $valid = 1;
        $error_message = '';

        if(empty($_POST['name'])) {
            $valid = 0;
            $error_message .= "Customer Name cannot be empty"."<br>";
        }

        if(empty($_POST['email'])) {
            $valid = 0;
            $error_message .= "Email Address cannot be empty"."<br>";
        } else {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
                $valid = 0;
                $error_message .= "Email Address must be valid"."<br>";
            } else {
                $statement = $conn->prepare("SELECT * FROM customers WHERE customer_email=?");
                $statement->execute(array($_POST['email']));
                $total = $statement->rowCount();                            
                if($total) {
                    $valid = 0;
                    $error_message .= "Email Already exists"."<br>";
                }
            }
        }

        if(empty($_POST['phone'])) {
            $valid = 0;
            $error_message .= "Phone cannot be empty"."<br>";
        }

        if(empty($_POST['address'])) {
            $valid = 0;
            $error_message .= "Address cannot be empty"."<br>";
        }

        if(empty($_POST['password']) || empty($_POST['rpassword'])) {
            $valid = 0;
            $error_message .= "Password cannot be empty"."<br>";
        }

        if(!empty($_POST['password']) && !empty($_POST['rpassword'])) {
            if($_POST['password'] != $_POST['rpassword']) {
                $valid = 0;
                $error_message .= "Password do not match"."<br>";
            }
        }

        if($valid == 1) {
            $token = md5(time());
            $timestamp = time();

            $statement = $conn->prepare("INSERT INTO customers (
                customer_name,
                customer_email,
                customer_phone,
                customer_address,
                customer_b_name,
                customer_b_phone,
                customer_b_region,
                customer_b_address,
                customer_b_city,
                customer_b_township,
                customer_b_zip,
                customer_s_name,
                customer_s_phone,
                customer_s_region,
                customer_s_address,
                customer_s_city,
                customer_s_township,
                customer_s_zip,
                customer_password,
                customer_token,
                timestamp
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            
            $statement->execute(array(
                strip_tags($_POST['name']),
                strip_tags($_POST['email']),
                strip_tags($_POST['phone']),
                strip_tags($_POST['address']),
                '', '', 0, '', '', '', '', '', '', 0, '', '', '', '', md5($_POST['password']), $token, $timestamp
            ));

            // Send email for confirmation of the account
            // $to = $_POST['email'];
            // $subject = "Registration Email Confirmation for YOUR WEBSITE";
            // $verify_link = BASE_URL.'verify.php?email='.$to.'&token='.$token;
            // $message = "Thank you for your registration! Your account has been created. To active your account click on the link below:<br><br>
            //             <a href='$verify_link'>$verify_link</a>";

            // $headers = "From: noreply@" . BASE_URL . "\r\n" .
            //             "Reply-To: noreply@" . BASE_URL . "\r\n" .
            //             "X-Mailer: PHP/" . phpversion() . "\r\n" . 
            //             "MIME-Version: 1.0\r\n" . 
            //             "Content-Type: text/html; charset=ISO-8859-1\r\n";
            try {
                //Server settings
                $mail->SMTPDebug=0;
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;
                $mail->Username   = 'ioncreat505@gmail.com';                     // SMTP username
                $mail->Password   = 'owbzpzqdxqpbnbjo';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
            //
           
                //Recipients
                $mail->setFrom('ioncreat505@gmail.com', 'cybercorner.com');
                $mail->addAddress($_POST['email']);     // Add a recipient
            
                // Content
                $mail->isHTML(true);
                $verification_code=substr(number_format(time()*rand(),0,'',''),0,6);
                $mail->Subject = 'Registration Email Confirmation for YOUR WEBSITE';
                // $verify_link = BASE_URL.'verify.php?email='.$_POST['email'].'&token='.$token;
                $mail->Body    = '<p>Your verification code is :<b style="font-size: 30px;">'.$verification_code.'</b></p>';
                $mail->send();
                $success_message = "Your registration is completed. A confirmation email has been sent.";
            } catch (Exception $e) {
                // $error_message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            // Sending Email
          

            unset($_POST['name']);
            unset($_POST['email']);
            unset($_POST['phone']);
            unset($_POST['address']);
            $success_message = "Your registration is completed.";
        }
    }
?>

<div class="row justify-content-center align-items-center">
    <div class="col-xl-5 col-md-8 col-sm-12">
        <div class="card pre m-5 rounded-0">
            <div class="card-header text-center text-primary">
                <h4 class="pt-2 text-warning"> Welcome to Shop! Please Register.</h4>   
            </div>
            <div class="card-body">
                <?php
                    if(!empty($error_message)) {
                        echo '<div class="error alert alert-warning">' . $error_message . '</div>';
                    }
                    if(!empty($success_message)) {
                        echo '<div class="success alert alert-warning">' . $success_message . '</div>';
                    }
                ?>

                <form action="" method="post">
                    <?php $csrf->echoInputField(); ?> 
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for=""><i class="feather-user text-primary"></i> Enter Full Name :</label>
                            <input type="text" name="name" id="" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>" class="form__input form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for=""><i class="feather-mail text-primary"></i> Enter email :</label>
                            <input type="email" name="email" id="" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" class="form__input form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for=""><i class="feather-phone text-primary"></i> Enter Phone No :</label>
                            <input type="text" name="phone" id="" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>" class="form__input form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for=""><i class="feather-lock text-primary"></i> Enter Password :</label>
                            <div class="input-group">
                                <input name="password" type="password" value="" class="form__input form-control" id="password" placeholder="*****" required="true" aria-label="password" aria-describedby="basic-addon1" />
                                <div class="input-group-append">
                                    <span class="input-group" onclick="password_show_hide();">
                                    <i class="far fa-eye" id="show_eye"></i>
                                    <i class="far fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group col-md-6">
                            <label for=""><i class="feather-lock text-primary"></i> Retype-Password :</label>
                            <div class="input-group">
                                <input name="rpassword" type="password" value="" class="form__input form-control" id="password" placeholder="*****" required="true" aria-label="password" aria-describedby="basic-addon1" />
                                <div class="input-group-append">
                                    <span class="input-group" onclick="password_show_hide();">
                                    <i class="far fa-eye" id="show_eye"></i>
                                    <i class="far fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for=""><i class="far fa-address-book text-primary"></i> Address :</label>
                        <textarea name="address" class="form-control form__input" cols="30" rows="10" style="height:70px;"><?php if(isset($_POST['address'])){echo $_POST['address'];} ?></textarea>
                    </div>
                    <div class="form-group pt-2 mb-0">
                        <button class="btn btn-primary rounded" name="regBtn">Register</button>
                        <a href="login.php" class="btn btn-link btn-dark rounded float-right"><i class="feather-log-in text-white"></i> Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require "template/footer.php"; ?>
