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
                        Manage categories
                    </h1>

                    <div class="col-xs-6">
                        <?php insert_categories(); ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cat-title">Category Title</label>
                                <input type="text" id="cat-title" name="cat_title" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category"/>
                            </div>
                        </form>
                        <?php
                        if (isset($_GET['edit'])) {
                            include "inc/edit_category.php";
                        }
                        ?>
                    </div>

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php find_all_categories(); ?>
                            </tbody>
                        </table>
                        <?php delete_category(); ?>
                    </div>

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
