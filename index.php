<?php 
require('config/config.php');
require('config/db.php');

$query = "SELECT * FROM posts";

$result = mysqli_query($conn, $query);

$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('inc/styles.php'); ?>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Blog</title>
</head>
<body>
<?php include('inc/navbar.php'); ?>
    <div class="container">
        <h1>Posts</h1>
        <?php foreach ($posts as $post) :?>  
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $post['title']; ?></h5>
                <h6 class="card-subtitle mb-2">Created on <?php echo $post['created_at']?> by <?php echo $post['author'];?></h6>
                <p class="card-text"><?php echo $post['body'] ?></p>
                <a class="card-link" href="<?php echo ROOT_URL?>post.php?id=<?php echo $post['id'];?>">Read More</a>
            </div>
        </div>
<?php endforeach;?>
    </div>
    <?php include('inc/scripts.php');?>
</body>
</html>