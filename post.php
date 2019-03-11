<?php 
require('config/config.php');
require('config/db.php');

if(isset($_POST['delete'])){
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

$query = "DELETE FROM posts WHERE id = {$delete_id}";

    if(mysqli_query($conn, $query)){
        header('Location: '.ROOT_URL);
    }else{
        echo "ERROR: ". mysqli_error($conn);
    }
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

$query = "SELECT * FROM posts WHERE id=$id";

$result = mysqli_query($conn, $query);

$post = mysqli_fetch_assoc($result);

mysqli_free_result($result);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('inc/styles.php'); ?>
    <title>Simple Blog | <?php echo $post['title'];?></title>
</head>
<body>
<?php include('inc/navbar.php'); ?>
    <div class="container">
        <a href="<?php echo ROOT_URL; ?>" class="mt-2 btn btn-primary">Go Back</a>
        <h1><?php echo $post['title']; ?></h1>
        <h6>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></h6>
        <p class="text">
            <?php echo $post['body']; ?>
        </p>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="float-right">
            <input type="hidden" name="delete_id" value="<?php echo $post['id'];?>">
            <input type="submit" value="Delete" name="delete" class="btn btn-danger">
        </form>
        <a class="btn btn-default" href="<?php echo ROOT_URL; ?>edit_post.php?id=<?php echo $post['id'];?>">Edit</a>
        <?php include("comments.php"); ?>
    </div>
    
    <?php include('inc/scripts.php');?>
</body>
</html>