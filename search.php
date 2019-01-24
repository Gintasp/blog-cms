<?php
include 'inc/header.php';
include 'inc/navigation.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php

            if (isset($_POST['submit'])) {
                $search = $_POST['search'];
                $query = "SELECT * FROM post WHERE tags LIKE '%$search%'";
                $select_query = mysqli_query($connection, $query);

                if (!$select_query) {
                    die('FAILED.' . mysqli_error($connection));
                }

                if (!mysqli_num_rows($select_query)) { ?>
                    <h1>No results.</h1>
                <?php } else {
                    while ($row = mysqli_fetch_assoc($select_query)) { ?>
                        <h2>
                            <a href="#"><?php echo $row['title']; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $row['author']; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['date']; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $row['image']; ?>" alt="">
                        <hr>
                        <p><?php echo $row['content']; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                    <?php }
                }
            } ?>

            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>
        </div>

        <?php include 'inc/sidebar.php'; ?>

    </div>
    <hr>
</div>

<?php include 'inc/footer.php' ?>
