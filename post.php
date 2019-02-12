<?php
include 'inc/header.php';
include 'inc/navigation.php';

if (isset($_POST['liked'])) {
    $liked_post_id = $_POST['post_id'];
    $liked_user_id = $_POST['user_id'];
    $query = mysqli_query($connection, "UPDATE post SET likes=likes+1 WHERE id=$liked_post_id");
    handle_query_error($query);

    $query = mysqli_query($connection, "INSERT INTO likes(user_id,post_id) VALUES($liked_user_id,$liked_post_id)");
    handle_query_error($query);
}

if (isset($_POST['unliked'])) {
    $liked_post_id = $_POST['post_id'];
    $liked_user_id = $_POST['user_id'];
    $query = mysqli_query($connection, "UPDATE post SET likes=likes-1 WHERE id=$liked_post_id");
    handle_query_error($query);

    $query = mysqli_query($connection, "DELETE FROM likes WHERE post_id=$liked_post_id AND user_id=$liked_user_id");
    handle_query_error($query);
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php
            if (isset($_GET['p_id'])) {
                $current_post_id = escape($_GET['p_id']);
                $query = mysqli_query($connection, "UPDATE post SET views=views+1 WHERE id=$current_post_id");
                handle_query_error($query);

                $query = mysqli_query($connection, "SELECT likes FROM post WHERE id=$current_post_id");
                handle_query_error($query);
                $likes = mysqli_fetch_assoc($query)['likes'];
            } else {
                header("Location: index.php");
            }

            $query = mysqli_query($connection, "SELECT * FROM post WHERE id={$current_post_id}");
            handle_query_error($query);

            while ($row = mysqli_fetch_assoc($query)) { ?>
                <h2>
                    <p><?php echo $row['title']; ?></p>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $row['author']; ?>"><?php echo $row['author']; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['date']; ?></p>
                <p style="margin: 0;font-size: 1.1em">Views: <?php echo $row['views']; ?></p>
                <hr style="margin-top: 5px;margin-bottom: 10px">
                <img class="img-responsive" src="images/<?php echo $row['image']; ?>" alt="">
                <hr>
                <p><?php echo $row['content']; ?></p>
                <hr>
                <a style="margin-bottom: 10px;" href="" class="like-button btn btn-success"><i
                            class="far fa-thumbs-up fa-2x"></i>
                    Like</a>
                <p style="margin-bottom: 15px;font-size: 1.1em">Likes: <span
                            class="likes-handle"><?php echo $likes; ?></span></p>
                <a style="margin-bottom: 10px;" href="" class="unlike-button btn btn-danger"><i
                            class="far fa-thumbs-down fa-2x"></i>
                    Unlike</a>
            <?php }
            include 'inc/post_comments.php';
            ?>
        </div>
        <?php include 'inc/sidebar.php'; ?>
    </div>
</div>

<?php include 'inc/footer.php' ?>
<script>
    $(document).ready(function () {
        let postId =<?php echo $current_post_id;?>;
        let userId =<?php if (isset($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>;

        $('.like-button').on('click', function (e) {
            $.ajax({
                url: '/cms/post.php?p_id=' + postId,
                type: 'post',
                data: {
                    liked: 1,
                    post_id: postId,
                    user_id: userId
                }
            });
        });

        $('.unlike-button').on('click', function (e) {
            $.ajax({
                url: '/cms/post.php?p_id=' + postId,
                type: 'post',
                data: {
                    unliked: 1,
                    post_id: postId,
                    user_id: userId
                }
            });
        });
    });
</script>
