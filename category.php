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
            if (isset($_GET['category'])) {
                $category_id = escape($_GET['category']);
            }

            $query = mysqli_query($connection, "SELECT * FROM post WHERE category_id={$category_id} ORDER BY date DESC");
            handle_query_error($query);
            while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <h2>
                    <a href="post.php?p_id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $row['author']; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['date']; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $row['image']; ?>" alt="">
                <hr>
                <p><?php echo substr($row['content'], 0, 150); ?></p>
                <a class="btn btn-primary" href="#">Read More <span
                            class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php } ?>
        </div>
        <?php include 'inc/sidebar.php'; ?>
    </div>
    <hr>
</div>

<?php include 'inc/footer.php' ?>
