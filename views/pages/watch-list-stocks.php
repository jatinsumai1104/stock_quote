
<?php
  require_once('../../helper/constants.php');
  require_once(__DIR__.'/../../helper/init.php');

?>
<!DOCTYPE html>
<html lang="en">

<!-- Header containing all Links -->
<?php
  require_once('../includes/header.php');
  
?>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php
      require_once('../includes/sidebar.php');
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php
          require_once('../includes/navbar.php');
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Watch List</h1>
            <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Stocks Into Watch List</a>
          </div>
          
          <?php 
          
          $stocks = $di->get("WatchList")->getStocksNameByID($_GET["watch_list"]);
          foreach($stocks as $stock){
          ?>
            <a href="hello">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> <?php echo $stock["stock_name"];?>
                    </h6>
                </div>
              </div>
            </a>
          <?php } ?>
          

            




          <!-- Content Row -->
          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php
        require_once('../includes/footer.php');
      ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- All Required Scripts  -->
  
  
  
  <?php
    require_once('../includes/scripts.php');
  ?>

</body>
</html>