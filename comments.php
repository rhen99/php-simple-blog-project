<?php 
require('config/db.php');


if(isset($_POST['send'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $text = mysqli_real_escape_string($conn, $_POST['comment-body']);

    $query = "INSERT INTO comments(name, email, website, text, post_id) VALUES ('$name', '$email', '$website', '$text','$id')";

    if(mysqli_query($conn, $query)){
        header('Location: '.$_SERVER['PHP_SELF'].'?id='.$id);
    }else{
        echo "ERROR: ". mysqli_error($conn);
    }
}
$query = "SELECT * FROM comments WHERE post_id = $id";

$result = mysqli_query($conn, $query);


$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

?>
<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" class="mt-3">
    <div class="row">
        <div class="col">
        <label>Name</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="col">
        <label>Email</label>
        <input type="text" class="form-control" name="email">
    </div>
    </div>
    <div class="form-group">
        <label>Website</label>
        <input type="text" name="website" class="form-control">
    </div>
    <div class="form-group">
        <label>Text</label>
        <textarea name="comment-body" class="form-control"></textarea>
    </div>
    <input type="submit" name="send" value="Send" class="btn btn-success btn-block">
</form>
<div class="col-md-12">
    <?php foreach($comments as $comment):?>
            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-title"><?php echo $comment['name'] ?></h6>
                    <span><?php echo $comment['email']; ?> - <small><?php echo $comment['website']; ?></small></span>
                    <div class="card-text">
                        <?php echo $comment['text'] ?>
                    </div>
                </div>
            </div>
    <?php endforeach; ?>
</div>