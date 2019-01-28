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
            if (isset($_GET['author'])) {
                $author = $_GET['author'];
            }

            $query = mysqli_query($connection, "SELECT * FROM post WHERE author='{$author}'");
            handle_query_error($query);

            while ($row = mysqli_fetch_assoc($query)) { ?>
                <h2>
                    <p><?php echo $row['title']; ?></p>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $author; ?>"><?php echo $row['author']; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['date']; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $row['image']; ?>" alt="">
                <hr>
                <p><?php echo substr($row['content'], 0, 150); ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $row['id']; ?>">Read More <span
                            class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
            <?php } ?>
        </div>
        <?php include 'inc/sidebar.php'; ?>
    </div>
</div>

<?php include 'inc/footer.php' ?>
