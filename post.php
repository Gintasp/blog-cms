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
            if (isset($_GET['p_id'])) {
                $current_post_id = $_GET['p_id'];

                $query = mysqli_query($connection, "UPDATE post SET views=views+1 WHERE id=$current_post_id");
                handle_query_error($query);
            } else {
                header("Location: index.php");
            }

            $query = mysqli_query($connection, "SELECT * FROM post WHERE id={$current_post_id}");
            handle_query_error($query);

            while ($row = mysqli_fetch_assoc($query)) { ?>
                <h2>
                    <p><?php echo $row['title']; ?></p>
                </h2>
                <p class="lead">
                    by <a href="#"><?php echo $row['author']; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['date']; ?></p>
                <p style="margin-bottom: 0;font-size: 1.1em">Views <?php echo $row['views']; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $row['image']; ?>" alt="">
                <hr>
                <p><?php echo $row['content']; ?></p>
                <hr>
            <?php }
            include 'inc/post_comments.php';
            ?>
        </div>
        <?php include 'inc/sidebar.php'; ?>
    </div>
</div>

<?php include 'inc/footer.php' ?>
