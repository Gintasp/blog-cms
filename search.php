<?php
include 'inc/header.php';
include 'inc/navigation.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">

            <h1 class="page-header">
                Search results
            </h1>

            <?php

            if (isset($_POST['submit'])) {
                $search = escape($_POST['search']);
                $query = mysqli_query($connection, "SELECT * FROM post WHERE tags LIKE '%$search%' AND status='published'");
                handle_query_error($query);

                if (!mysqli_num_rows($query)) { ?>
                    <h1>No results.</h1>
                <?php } else {
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <h2>
                            <a href="post.php?p_id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                        </h2>
                        <p class="lead">
                            by
                            <a href="author_posts.php?author=<?php echo $row['author']; ?>"><?php echo $row['author']; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['date']; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $row['image']; ?>" alt="">
                        <hr>
                        <p><?php echo $row['content']; ?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $row['id']; ?>">Read More <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>
                    <?php }
                }
            } ?>
        </div>

        <?php include 'inc/sidebar.php'; ?>

    </div>
    <hr>
</div>

<?php include 'inc/footer.php' ?>
