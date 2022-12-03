<?php

require '../config/config.php';
session_start();
//check whether user is logged in or not
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
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    
      <form class="form-inline ml-3" method="POST" action="index.php">
        <div class="input-group input-group-sm">
          <input name="search" class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <div class="container">
        <a href="logout.php" type="button" class="ml-auto btn btn-danger">Logout</a>
      </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Blog Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Blogs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="add_new_user_by_admin.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Blogs List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="add.php" type="button" class="btn btn-info float-right"><i class="fas fa-plus">
                </i> Create New</a>
          
                <table class="table table-bordered mt-5">
                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Content</th>
                      <th>Image</th>
                      <th colspan="2">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      if (!empty($_GET['pageno'])) 
                      {
                       $pageno = $_GET['pageno'];
                      }
                      else
                      {
                        $pageno = 1;
                      }

                      $numOfrecs = 3; // number of records in one one page
                      $offset = ($pageno - 1) * $numOfrecs; // offset algorithm

                      if (empty($_POST['search'])) 
                      {
                        $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
                        $stmt->execute();
                        $rawResult = $stmt->fetchAll();

                        $total_pages = ceil(count($rawResult)/ $numOfrecs); //to get total pages

                        $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$numOfrecs");
                        $stmt->execute();
                        $result = $stmt->fetchAll();

  
                        if ($result) 
                        { 
                          $i = 1;
                          foreach ($result as $value) 
                          { ?>
                            <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $value['title'];?></td>
                            <td><?php echo substr($value['content'],0,50);?>
                            </td>
                            <td><?php echo $value['image'];?>
                            </td>
                            <td><a href="edit.php?id=<?php echo $value['id'];?>" type="button" class="btn btn-warning ml-3"><i class="fas fa-pen"></i> Edit</a>
                            <a href="delete.php?id=<?php echo $value['id'];?>" type="button" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a></td>
                            </tr>
                            <?php    
                            $i++;
                          }
                        }
                      }
                      else
                      {
                        $searchKey = $_POST['search'];

                        $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchKey%' ORDER BY id DESC");
                        $stmt->execute();
                        $rawResult = $stmt->fetchAll();

                        $total_pages = ceil(count($rawResult)/ $numOfrecs); //to get total pages

                        $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchKey%' ORDER BY id DESC LIMIT $offset,$numOfrecs");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                       
                        if ($result) 
                        { 
                          $i = 1;
                          foreach ($result as $value) 
                          { ?>
                            <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $value['title'];?></td>
                            <td><?php echo substr($value['content'],0,50);?>
                            </td>
                            <td><?php echo $value['image'];?>
                            </td>
                            <td><a href="edit.php?id=<?php echo $value['id'];?>" type="button" class="btn btn-warning ml-3"><i class="fas fa-pen"></i> Edit</a>
                            <a href="delete.php?id=<?php echo $value['id'];?>" type="button" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a></td>
                            </tr>
                            <?php    
                            $i++;
                          }
                        }
                      }
                          
                    ?>
                    
                  </tbody>
                </table>
                <br>
                <!-- for pageno navbar -->
                <!-- First = the first page no  -->
                <!-- Previous( << ) = if current page no is less than or equal to 1, previous button will be disabled -->
                <!-- Next( >> ) = if current page no is greater than or equal to total pages, next button can't be click -->
                <!-- Current page = current page no -->
                <!-- Last = the last page no -->
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-end">
                    <li class="page-item">
                      <a class="page-link" href="?pageno=1">First</a>
                    </li>
                    <li class="page-item <?php if ($pageno <= 1) {echo 'disabled'; }?>">
                      <a class="page-link" href="<?php if($pageno <=1) { echo '#'; } else { 
                        echo "?pageno=".($pageno-1); } ?>"><<</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#"><?php echo $pageno; ?></a>
                    </li>
                    <li class="page-item"<?php if ($pageno >= $total_pages) {echo 'disabled'; }?>">
                      <a class="page-link" href="<?php if($pageno >= $total_pages) { echo '#'; } else { 
                        echo "?pageno=".($pageno+1); } ?>">>></a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a>
                    </li>
                  </ul>
                </nav>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="#">AdminLTE.io</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
