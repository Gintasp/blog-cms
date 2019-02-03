<form action="" method="POST">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php
        if (isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $query = mysqli_query($connection, "SELECT * FROM category WHERE id={$edit_id}");
            while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <input value="<?php if (isset($row['title'])) {
                    echo $row['title'];
                } ?>" type="text" id="cat-title" name="cat_title" class="form-control"/>

                <?php
            }
        }

        if (isset($_POST['update'])) {
            $title = escape($_POST['cat_title']);
            $query = mysqli_query($connection, "UPDATE category SET title='{$title}' WHERE id={$edit_id}");
            handle_query_error($query);
            header("Location: categories.php");
        }
        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update"/>
    </div>
</form>