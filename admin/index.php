<?php
include 'inc/header.php';
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
                        <small><?php echo $_SESSION['firstname']; ?></small>
                    </h1>

                    <?php include "inc/widgets.php"; ?>
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
