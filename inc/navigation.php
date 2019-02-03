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
                    $category_active = '';
                    $register_active = '';
                    $contact_active = '';
                    $url = basename($_SERVER['PHP_SELF']);
                    if (isset($_GET['category']) && $_GET['category'] === $row['id']) {
                        $category_active = 'active';
                    } elseif ($url === 'register.php') {
                        $register_active = 'active';
                    } elseif ($url === 'contact.php') {
                        $contact_active = 'active';
                    }
                    ?>
                    <li class="<?php echo $category_active; ?>">
                        <a href="category.php?category=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                    </li>
                <?php }
                if (isset($_SESSION['username'])) {
                    if ($_SESSION['role'] === 'admin') {
                        ?>
                        <li>
                            <a href="admin/index.php">Admin</a>
                        </li>
                        <?php

                        if (isset($_GET['p_id'])) {
                            ?>
                            <li>
                                <a href="admin/posts.php?source=edit_post&p_id=<?php echo $_GET['p_id']; ?>">Edit
                                    Post</a>
                            </li>
                        <?php }

                    }
                }
                if (!isset($_SESSION['username'])) {
                    ?>
                    <li class="<?php echo $register_active; ?>">
                        <a href="register.php">Register</a>
                    </li>
                <?php } ?>
                <li class="<?php echo $contact_active; ?>">
                    <a href="contact.php">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
