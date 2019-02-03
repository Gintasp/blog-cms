<?php
include 'inc/header.php';
include 'inc/navigation.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php
            if (isset($_GET['author'])) {
                $author = escape($_GET['author']);
            }

            $query = mysqli_query($connection, "SELECT * FROM post WHERE author='{$author}'");
            handle_query_error($query);
            ?>
            <h1 class="page-header">
                Posts by
                <small><?php echo $author; ?></small>
            </h1>

            <?php
            while ($row = mysqli_fetch_assoc($query)) { ?>
                <h2><a href="post.php?p_id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h2>
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
