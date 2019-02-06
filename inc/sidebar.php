<div class="col-md-4">
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
            </div>
        </form>
    </div>

    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    $query = mysqli_query($connection, 'SELECT * FROM category LIMIT 10');
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <li><a href="category.php?category=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
