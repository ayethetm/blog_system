<?php

session_start();
require 'config/config.php';
require 'config/common.php';
//check whether user is logged in or not
if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
  header('Location:login.php');
}

//fetch get data by $_GET id
$stmt = $pdo->prepare('SELECT * FROM posts WHERE id='.$_GET['id']);
$stmt->execute();
$result = $stmt->fetchAll();

//for posting comment
$author_id = $_SESSION['user_id'];
$post_id = $_GET['id'];
if ($_POST) {
  $comment = $_POST['comment'];
  if (empty($comment))
  {
    $cmtError = 'Comment cannot be null';
  }
  else{
    $comment_stmt = $pdo->prepare("INSERT INTO comments(content,author_id,post_id) VALUES(:content,:author_id,:post_id)");
  $result = $comment_stmt->execute(
    array(
          ':content' => $comment,
          ':author_id' => $author_id,
          ':post_id' => $post_id)
       );

       if($result)
       {
        header('Location:blogdetail.php?id='.$post_id);
       }
  }
  }
  
  

  //to get all comments under related post
  $cmts_stmt = $pdo->prepare('SELECT * FROM comments WHERE post_id='.$post_id);
  $cmts_stmt->execute();
  $cmts_result = $cmts_stmt->fetchAll();
  
  //to get comment user info
  $cmtResult = [];
  if ($cmts_result) {
    foreach ($cmts_result as $key => $value) 
    {
      $authorId = $cmts_result[$key]['author_id'];
      $cmt_user_stmt = $pdo->prepare('SELECT * FROM users WHERE id='.$authorId);
      $cmt_user_stmt->execute();
      $cmtResult[] = $cmt_user_stmt->fetchAll();
    }
  }


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Blog | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="
  plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="
  dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">


  <!-- Content Wrapper. Contains page content -->
  
      <div class="container-fluid">
        <div class="row mt-2 mb-5">
          <div class="col-sm-12">
            <h1 style="text-align:center">Blogs Site</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
       <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <h4 style="text-align:center"><?php echo $result[0]['title']; ?></h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <image class="img-fluid pad" src="images/<?php echo $result[0]['image']; ?>" />
                <p class="mt-5 mb-3"><?php echo $result[0]['content']; ?><p>
                <a href="index.php" type="button" class="btn btn-sm btn-secondary float-right"><i class="fas fa-back">
                </i>Back to Home</a>
                <br>
                <hr>
                <h4 class="float-left text-muted">Comments</h4>
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments" >
                <div class="card-comment" >
                <?php 
                  foreach ($cmts_result as $key => $value) 
                  { ?>
                  <div class="comment-text" style="margin-left:0px !important">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="dist/img/avatar2.png" alt="User Image">
                    <span class="username">
                      <?php print_r($cmtResult[$key][0]['name']); ?>
                      <span class="text-muted float-right"><?php echo $value['created_at']; ?></span>
                    </span><!-- /.username -->
                    <?php echo $value['content']; ?>
                  </div>
                  <hr>
                    
                <?php  }
                ?>
                
                </div>
               
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="" method="post">
                  <!-- token hidden  -->
                  <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                  
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <p style="color:red;"><?php echo empty($cmtError)? '' : '*'.$cmtError ?></p>
                  <div class="img-push">
                    <input type="text" name="comment" class="form-control form-control-sm" placeholder="Press enter to post comment">
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  -->
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left:0px !important">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
    <a href="logout.php" type="button" class="btn btn-sm btn-danger float-right">Logout</a>
  </footer>

 
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="
plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="
plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="
dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="
dist/js/demo.js"></script>
</body>
</html>
