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
                        <h1 class="h3 mb-0 text-gray-800">Video Guide</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-6">
                          <video controls style="width: 100%">
                              <source src="<?php echo BASEASSETS; ?>video/tutorial-1.mp4" type="video/mp4">
                              <source src="movie.ogg" type="video/ogg">
                              Your browser does not support the video tag.
                            </video>
                            <h5 class="text-center">Complete Overview</h5>
                          </div>
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




<script>


</script>

</body>

</html>