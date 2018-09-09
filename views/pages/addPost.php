<?php include '../include/header.php'; ?>

<?php

require_once APPROOT . '/config/Database.php';
require_once APPROOT . '/models/Post.php';

?>

<h1 class="text-center w-100 mb-5 mt-4">Add New Post</h1>

<hr>

<form action="<?php echo APPROOT.'/app/addPost.php' ?>" method="POST">
  <div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label font-weight-bold">Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="title">
    </div>
  </div>
  <div class="form-group row">
    <label for="body" class="col-sm-2 col-form-label font-weight-bold">Post Body</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" id="body" rows="7"></textarea>
    </div>
  </div>
 <hr>
  <div class="form-group row">
    <div class="col-sm-12 d-flex justify-content-center">
      <button type="submit" name="addPost" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>

