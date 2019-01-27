<table class="table table-bordered table-hover">
    <thead>
    <tr>
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

<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = mysqli_query($connection, "DELETE FROM post WHERE id=$id");
    handle_query_error($query);
    header('Location: posts.php');
}