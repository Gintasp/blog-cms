<?php
include 'inc/header.php';
include 'inc/navigation.php';
?>

    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <h1 class="page-header">
                    Blog Posts
                </h1>

                <?php
                $page = 1;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                }

                if ($page == 1) {
                    $page1 = 0;
                } else {
                    $page1 = ($page * 5) - 5;
                }

                $query = mysqli_query($connection, "SELECT * FROM post WHERE LOWER(status)='published'");
                handle_query_error($query);
                $post_count = mysqli_num_rows($query);
                if ($post_count < 1) {
                    ?>
                    <h2>There are no posts available.</h2>
                <?php } else {
                    $post_count = ceil($post_count / 5);

                    $query = mysqli_query($connection, "SELECT * FROM post WHERE LOWER(status)='published' ORDER BY date DESC LIMIT $page1,5");
                    handle_query_error($query);

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
                        <a href="post.php?p_id=<?php echo $row['id']; ?>">
                            <img class="img-responsive" src="images/<?php echo $row['image']; ?>" alt="">
                        </a>
                        <hr>
                        <p><?php echo substr($row['content'], 0, 150); ?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $row['id']; ?>">Read More <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>
                    <?php }
                } ?>

                <ul class="pager">
                    <?php
                    for ($i = 1; $i <= $post_count; $i++) {
                        if ($i == $page) {
                            ?>
                            <li><a class="active" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } else {
                            ?>
                            <li><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                        }
                    } ?>
                </ul>
            </div>

            <?php include 'inc/sidebar.php'; ?>

        </div>
        <hr>
    </div>

<?php include 'inc/footer.php';
