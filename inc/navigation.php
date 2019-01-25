<?php
include 'db.php';
session_start();
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Blog Home</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = 'SELECT * FROM category';
                $select_all_categories_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $title = $row['title']; ?>
                    <li>
                        <a href="#"><?php echo $title; ?></a>
                    </li>
                <?php }
                if (isset($_SESSION['username'])) {
                    if ($_SESSION['role'] === 'admin') {
                        ?>
                        <li>
                            <a href="admin/index.php">Admin</a>
                        </li>
                    <?php }
                } ?>

            </ul>
        </div>
    </div>
</nav>