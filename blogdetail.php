<?php
require 'config/config.php';
session_start();
//check whether user is logged in or not
if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
  header('Location:login.php');
}

//fetch get data by $_GET id
$stmt = $pdo->prepare('SELECT * FROM posts WHERE id='.$_GET['id']);
$stmt->execute();
$result = $stmt->fetchAll();

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
                <p class="mt-5"><?php echo $result[0]['content']; ?><p>
                <hr>
                <h5 class="float-left text-muted">Comments</h5>
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="
                  dist/img/user3-128x128.jpg" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will 
                    distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="
                  dist/img/user4-128x128.jpg" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Luna Stark
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will 
                    distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="#" method="post">
                  <img class="img-fluid img-circle img-sm" src="
                  dist/img/user4-128x128.jpg" alt="Alt Text">
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
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

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
 
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left:0px !important">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
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
