<?php
include "inc/header.php";
include "inc/navigation.php";

if (isset($_POST['submit'])) {
    $to = "gplonis@gmail.com";
    $subject = escape($_POST['subject']);
    $body = escape($_POST['body']);
    $from = "From: " . escape($_POST['email']);

    if (!empty($subject) && !empty($body)) {
        mail($to, $subject, $body, $from);
    }
}
?>
    <div class="container">
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                            <h1>Contact</h1>
                            <form role="form" action="" method="post" id="login-form"
                                  autocomplete="off">
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                           placeholder="somebody@example.com">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Subject</label>
                                    <input type="text" name="subject" id="key" class="form-control"
                                           placeholder="Enter a Subject">
                                </div>
                                <div class="form-group">
                                    <textarea name="body" class="form-control" cols="40" rows="10"></textarea>
                                </div>
                                <input type="submit" name="submit" id="btn-login"
                                       class="btn btn-custom btn-lg btn-block"
                                       value="Send">
                            </form>
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>
        <hr>
<?php include "inc/footer.php";
