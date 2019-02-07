<?php include "inc/header.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

if (isset($_GET['fid'])) {
    header("Location: index.php");
}

if (check_method('post')) {
    if (isset($_POST['email'])) {
        $email = trim(escape($_POST['email']));
        $token = bin2hex(openssl_random_pseudo_bytes(50));

        if (email_valid($email)) {
            $stmt = mysqli_prepare($connection, "UPDATE user SET token='$token' WHERE email=?");
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = Config::SMTP_HOST;
                $mail->Username = Config::SMTP_USER;
                $mail->Password = Config::SMTP_PASSWORD;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 25;

                $mail->setFrom('admin@cms.com', 'Admin CMS');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset';
                $mail->Body = '<p>Click this link to reset your password: <a href="http://localhost/cms/reset.php?email=' . $email . '&token=' . $token . '">http://localhost/cms/reset.php?email=' . $email . '&token=' . $token . '</a></p>';

                $mail->send();
                $emailSent = true;
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                $emailSent = false;
            }
        }
    }
}
?>

<div class="container">
    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <?php if ($emailSent) { ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">
                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address"
                                                       class="form-control" type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block"
                                                   value="Reset Password" type="submit">
                                        </div>
                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>
                                </div><!-- Body-->
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <?php include "inc/footer.php"; ?>
</div> <!-- /.container -->

