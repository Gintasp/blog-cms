<?php
if (isset($_POST['apply']) && isset($_POST['bulk']) && isset($_POST['option_boxes'])) {
    $option_boxes = $_POST['option_boxes'];
    $option = $_POST['bulk'];

    foreach ($option_boxes as $box_id) {
        switch ($option) {
            case 'publish':
                $query = mysqli_query($connection, "UPDATE post SET status='Published' WHERE id=$box_id");
                break;
            case 'draft':
                $query = mysqli_query($connection, "UPDATE post SET status='Draft' WHERE id=$box_id");
                break;
            case 'delete':
                $query = mysqli_query($connection, "DELETE FROM post WHERE id=$box_id");
                break;
        }
        handle_query_error($query);
    }
}
?>

    <form action="" method="post">
        <table class="table table-bordered table-hover">
            <div style="margin-bottom: 30px" id="bulk-options-container" class="col-xs-4">
                <label for="options">Options</label>
                <select class="form-control" name="bulk" id="options">
                    <option value="">Select Option</option>
                    <option value="publish">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class="col-xs-4">
                <input type="submit" name="apply" value="Apply" class="btn btn-success">
                <a href="?source=add_post" class="btn btn-primary">Add New</a>
            </div>
            <thead>
            <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = mysqli_query($connection, "SELECT * FROM post");
            handle_query_error($query);

            while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td><input class="option-box" type="checkbox" value="<?php echo $row['id']; ?>" name="option_boxes[]"></td>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['author'] ?></td>
                    <td><?php echo $row['title'] ?></td>
                    <?php
                    $query_cat_id = mysqli_query($connection, "SELECT * FROM category WHERE id={$row['category_id']}");
                    handle_query_error($query_cat_id);
                    ?>
                    <td><?php echo mysqli_fetch_assoc($query_cat_id)['title']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><img style="width: 100px" src="../images/<?php echo $row['image']; ?>"></td>
                    <td><?php echo $row['tags']; ?></td>
                    <td><?php echo $row['comment_count']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><a href="../post.php?p_id=<?php echo $row['id']; ?>">View</a></td>
                    <td><a href="posts.php?source=edit_post&p_id=<?php echo $row['id']; ?>">Edit</a></td>
                    <td><a href="posts.php?delete=<?php echo $row['id']; ?>">Delete</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </form>
    `

<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = mysqli_query($connection, "DELETE FROM post WHERE id=$id");
    handle_query_error($query);
    header('Location: posts.php');
}