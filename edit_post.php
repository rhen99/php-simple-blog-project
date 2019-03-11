<?php 
require('config/config.php');
require('config/db.php');

if(isset($_POST['submit'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);

    $query = "UPDATE posts SET 
    title='$title',
    author='$author',
    body='$body'
     WHERE id={$update_id}";

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
    <title>Simple Blog | Edit Post</title>
</head>
<body>
    <?php include('inc/navbar.php');?>
    <div class="container">
        <h1>Edit Post</h1>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>">
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control" value="<?php echo $post['author']; ?>">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea name="body" class="form-control"><?php echo $post['body']; ?></textarea>
                </div>
                <input type="hidden" name="update_id" value="<?php echo $post['id'] ?>">
                <input type="submit" value="Update" name="submit" class="btn btn-success">
        </form>
    </div>
</body>
</html>