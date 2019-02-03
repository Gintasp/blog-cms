<?php

if (isset($_GET['p_id'])) {
    $post_id = escape($_GET['p_id']);
    $query = mysqli_query($connection, "SELECT * FROM post WHERE id=$post_id");
    handle_query_error($query);
    $post = mysqli_fetch_assoc($query);
}

if (isset($_POST['update_post'])) {
    $title = escape($_POST['title']);
    $author = escape($_POST['author']);
    $category = escape($_POST['category']);
    $status = escape($_POST['status']);
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $tags = escape($_POST['tags']);
    $content = escape($_POST['content']);

    if (empty($image)) {
        $image = $post['image'];
    }
    move_uploaded_file($image_temp, "../images/$image");

    $query = "UPDATE post SET category_id='{$category}', title='{$title}',author='{$author}', date=now(), image='{$image}', ";
    $query .= "content='{$content}', tags='{$tags}', status='{$status}' WHERE id=$post_id";
    $add_post_query = mysqli_query($connection, $query);
    handle_query_error($add_post_query);
    header('Location: posts.php');
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?php echo $post['title']; ?>">
    </div>

    <div class="form-group">
        <label for="category">Post Category</label>
        <select class="form-control" name="category" id="category">
            <?php
            $query = mysqli_query($connection, "SELECT * FROM category");
            handle_query_error($query);
            while ($row = mysqli_fetch_assoc($query)) { ?>
                <option <?php if ($post['category_id'] === $row['id']) {
                    echo 'selected';
                } ?> value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" id="author" value="<?php echo $post['author']; ?>">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <select class="form-control" name="status" id="status">
            <option value="Draft" <?php if (strtolower($post['status']) === 'draft') {
                echo 'selected';
            } ?>>Draft
            </option>
            <option value="Published" <?php if (strtolower($post['status']) === 'published') {
                echo 'selected';
            } ?>>
                Published
            </option>
        </select>
    </div>

    <div class="form-group">
        <img style="width: 100px" src="../images/<?php echo $post['image']; ?>" alt="<?php echo $post['image']; ?>">
        <label for="image">Post Image</label>
        <input type="file" name="image" id="image">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" id="tags" value="<?php echo $post['tags']; ?>">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="content" cols="30"
                  rows="10"><?php echo $post['content']; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>