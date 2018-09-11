<?php include '../include/header.php'; ?>

<?php

require_once APPROOT . '/config/Database.php';
require_once APPROOT . '/models/Post.php';

if(isset($_POST['pid'])) {

  $database = new Database;
  $db = $database->connect();

  $post = new Post($db);

  $post->id = $_POST['pid'];

  $result = $post->readPost();

  if($result) {

    $singlePost = $result->fetch(PDO::FETCH_ASSOC);

  } else {

    print_r($result->errorInfo());

  }

} else {

  header('Location: /');

}

?>

<h1 class="text-center w-100 mb-5 mt-4">Edit Your Post</h1>

<hr>

<form action="/app/addPost.php" method="POST">

  <input type="hidden" name="pid" value="<?php echo $singlePost['id']; ?>">

  <div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label font-weight-bold">Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="title" id="title" value="<?php echo $singlePost['title']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="body" class="col-sm-2 col-form-label font-weight-bold">Post Body</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="body" id="body" rows="7"><?php echo $singlePost['body']; ?></textarea>
    </div>
  </div>
 <hr>
  <div class="form-group row">
    <div class="col-sm-12 d-flex justify-content-center">
      <button type="submit" name="addPost" class="btn btn-primary">Save Changes</button>
    </div>
  </div>
</form>

<?php include '../include/footer.php'; ?>