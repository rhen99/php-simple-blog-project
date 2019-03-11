<?php 
require('config/config.php');
require('config/db.php');

if(isset($_POST['submit'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);

    $query = "INSERT INTO posts(title, author, body) VALUES ('$title', '$author', '$body')";

    if(mysqli_query($conn, $query)){
        header('Location: '.ROOT_URL);
    }else{
        echo "ERROR: ". mysqli_error($conn);
    }
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('inc/styles.php'); ?>
    <title>Simple Blog | Add Post</title>
</head>
<body>
    <?php include('inc/navbar.php');?>
    <div class="container">
        <h1>Add Post</h1>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea name="body" class="form-control"></textarea>
                </div>
                <input type="submit" value="Submit" name="submit" class="btn btn-success">
        </form>
    </div>
</body>
</html>