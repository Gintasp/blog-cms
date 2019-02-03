<?php
include "inc/header.php";
?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include 'inc/navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin dashboard,
                        <small><?php if ($_SESSION['firstname']) {
                                echo $_SESSION['firstname'];
                            } else {
                                echo $_SESSION['username'];
                            } ?></small>
                    </h1>

                    <?php
                    $source = '';
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    }

                    switch ($source) {
                        case 'add_user':
                            include "inc/add_user.php";
                            break;
                        case 'edit_user':
                            include "inc/edit_user.php";
                            break;
                        default:
                            include "inc/users_table.php";
                    }
                    ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include 'inc/footer.php'; ?>
