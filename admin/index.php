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
                        <small><?php if ($_SESSION['firstname']) {
                                echo $_SESSION['firstname'];
                            } else {
                                echo $_SESSION['username'];
                            } ?></small>
                    </h1>

                    <?php include "inc/widgets.php"; ?>
                    <div class="row" style="padding-left: 20px">
                        <div id="columnchart_material" style="width: 100%;height: 400px"></div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<?php
$query = mysqli_query($connection, "SELECT * FROM post WHERE LOWER(status)='draft'");
handle_query_error($query);
$draft_count = mysqli_num_rows($query);

$query = mysqli_query($connection, "SELECT * FROM comment WHERE LOWER(status)='unapproved'");
handle_query_error($query);
$unapproved_count = mysqli_num_rows($query);

$query = mysqli_query($connection, "SELECT * FROM user WHERE LOWER(role)='user'");
handle_query_error($query);
$subscriber_count = mysqli_num_rows($query);
?>
<!-- /#wrapper -->
<script type="text/javascript">
    google.charts.load('current', {'packages': ['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Data', 'Count'],
            <?php
            $elements = ['All Posts', 'Draft Posts', 'All Comments', 'Unapproved Comments', 'All Users', 'Subscribers', 'Categories'];
            $count = [$posts_count, $draft_count, $comments_count, $unapproved_count, $users_count, $subscriber_count, $categories_count];

            for ($i = 0; $i < count($elements); $i++) {
                echo "['{$elements[$i]}',{$count[$i]}],";
            }
            ?>
        ]);

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions());
    }
</script>
<?php include 'inc/footer.php'; ?>
