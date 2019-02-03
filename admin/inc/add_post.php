<?php
if (isset($_POST['add_post'])) {
    $title = escape($_POST['title']);
    $author = escape($_POST['author']);
    $category = escape($_POST['category']);
    $status = escape($_POST['status']);
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $tags = escape($_POST['tags']);
    $content = escape($_POST['content']);
    $date = date('d-m-y');

    move_uploaded_file($image_temp, "../images/$image");

    $query = "INSERT INTO post(category_id,title,author,date,image,content,tags,status) ";
    $query .= "VALUES('{$category}','{$title}','{$author}',now(),'{$image}','{$content}','{$tags}','{$status}')";
    $add_post_query = mysqli_query($connection, $query);
    handle_query_error($add_post_query);

    $id = mysqli_insert_id($connection); ?>
    <p class="alert alert-success" role="alert">Post successfully created.
        <a href="../post.php?p_id=<?php echo $id; ?>">View new post</a>.
    </p>

<?php } ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" id="title">
    </div>

    <div class="form-group">
        <label for="category">Post Category</label>
        <select class="form-control" name="category" id="category">
            <?php
            $query = mysqli_query($connection, "SELECT * FROM category");
            handle_query_error($query);
            while ($row = mysqli_fetch_assoc($query)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <select name="author" id="author" class="form-control">
            <option value="">Select User</option>
            <?php
            $user_query = mysqli_query($connection, "SELECT * FROM user");
            handle_query_error($user_query);
            while ($user_row = mysqli_fetch_assoc($user_query)) {
                ?>
                <option value="<?php echo $user_row['username']; ?>"><?php echo $user_row['username']; ?></option>
                <?php
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <select class="form-control" name="status" id="status">
            <option value="Draft">Draft</option>
            <option value="Published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image" id="image">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" id="tags">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_post" value="Publish Post">
    </div>
</form>