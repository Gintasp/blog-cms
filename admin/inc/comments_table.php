<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = mysqli_query($connection, "SELECT * FROM comment");
    handle_query_error($query);

    while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['content']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <?php
            $post_query = mysqli_query($connection, "SELECT * FROM post WHERE id={$row['post_id']}");
            handle_query_error($post_query);
            while ($post_row = mysqli_fetch_assoc($post_query)) {
                $title = $post_row['title']; ?>
                <td><a href="../post.php?p_id=<?php echo $post_row['id']; ?>"><?php echo $title; ?></a></td>
            <?php } ?>
            <td><?php echo $row['date']; ?></td>
            <td><a href="comments.php?approve=<?php echo $row['id']; ?>">Approve</a></td>
            <td><a href="comments.php?unapprove=<?php echo $row['id']; ?>">Unapprove</a></td>
            <td><a href="comments.php?delete=<?php echo $row['id']; ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = mysqli_query($connection, "DELETE FROM comment WHERE id=$id");
    handle_query_error($query);
    header('Location: comments.php');
}

if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $query = mysqli_query($connection, "UPDATE comment SET status='approved' WHERE id=$id");
    handle_query_error($query);
    header('Location: comments.php');
}

if (isset($_GET['unapprove'])) {
    $id = $_GET['unapprove'];
    $query = mysqli_query($connection, "UPDATE comment SET status='unapproved' WHERE id=$id");
    handle_query_error($query);
    header('Location: comments.php');
}