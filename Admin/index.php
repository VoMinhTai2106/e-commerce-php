<?php
function my_autoloader($class)
{
  $path = 'Model/';
  include_once $path . $class . '.php';
}
spl_autoload_register('my_autoloader');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <?php include_once './view/head.php' ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include_once './view/header.php' ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?php
    include_once './view/sidebar.php'
    ?>
    <!-- Content Wrapper. Contains page content -->
    <?php
    $ctrl = isset($_GET['action']) ? $_GET['action'] : 'dashboard';
    include_once "Controller/$ctrl.php";
    ?>
    <!-- /.content-wrapper -->
    <?php include_once './view/footer.php' ?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <?php include_once './view/script.php' ?>
</body>

</html>