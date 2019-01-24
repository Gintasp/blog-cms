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
                        Welcome to Admin dashboard!
                        <small>Author</small>
                    </h1>

                    <?php
                    $source = '';
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    }

                    switch ($source) {
                        case 'add_post':
                            include "inc/add_post.php";
                            break;
                        case 'edit_post':
                            include "inc/edit_post.php";
                            break;
                        default:
                            include "inc/comments_table.php";
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
