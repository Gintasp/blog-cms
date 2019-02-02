<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = mysqli_query($connection, "SELECT * FROM user");
    handle_query_error($query);

    while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?php echo $row['firstname'] ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td><a href="users.php?source=edit_user&u_id=<?php echo $row['id']; ?>">Edit</a></td>
            <td><a href="users.php?delete=<?php echo $row['id']; ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php
if (isset($_GET['delete']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        $id = mysqli_real_escape_string($connection, $_GET['delete']);
        $query = mysqli_query($connection, "DELETE FROM user WHERE id=$id");
        handle_query_error($query);
        header('Location: users.php');
    }
}