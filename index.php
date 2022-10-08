<?php
require 'config/config.php';
//check whether user is logged in or not
session_start();

if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
  header('Location:login.php');
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
        <div class="row my-5">
          <div class="col-sm-12">
            <h1 style="text-align:center">Blogs Site</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-3">
          
          <?php
            
            $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
            $stmt->execute();
            $result = $stmt->fetchAll();

            if ($result) 
                        { 
                          
                          foreach ($result as $value) 
                          { ?>
                            <div class="col-md-4">
                            <div class="card card-widget">
                              <div class="card-header">
                                <h4 style="text-align:center"><?php echo $value['title'];?></h4>
                              </div>
                              <div class="card-body">
                                <a href="blogdetail.php?id=<?php echo $value['id']; ?>"><image class="img-fluid pad" src="images/<?php echo $value['image']; ?>" style="width:400px; height:300px !important"/>
                              </a>
                              </div>
                            </div>
                            </div>
                            <?php    
                            
                          }
                        }

          ?>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
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
