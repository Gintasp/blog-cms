<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    <form role="form" method="post" action="">
        <div class="form-group">
            <input id="author" type="text" class="form-control" name="author" placeholder="Name">
        </div>
        <div class="form-group">
            <input id="email" type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <textarea id="comment" class="form-control" name="comment" rows="3" placeholder="Comment..."></textarea>
        </div>
        <button type="submit" name="create_comment" id="comment_submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<hr>

<?php
$post_id = $_GET['p_id'];
if (isset($_POST['create_comment'])) {
    $author = $_POST['author'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    if (!empty($author) && !empty($email) && !empty($comment)) {
        $query = mysqli_query($connection, "INSERT INTO comment(post_id, author, email, content, date, status) VALUES($post_id, '{$author}', '{$email}', '{$comment}', now(), 'unapproved')");
        handle_query_error($query);
        $query = mysqli_query($connection, "UPDATE post SET comment_count=comment_count+1 WHERE id=$post_id");
        handle_query_error($query);
    }
}
$all_comments = mysqli_query($connection, "SELECT * FROM comment WHERE post_id=$post_id AND status='approved' ORDER BY id DESC");
handle_query_error($all_comments);
while ($row = mysqli_fetch_assoc($all_comments)) {
    ?>
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $row['author']; ?>
                <small><?php echo $row['date']; ?></small>
            </h4>
            <?php echo $row['content']; ?>
        </div>
    </div>
<?php } ?>

