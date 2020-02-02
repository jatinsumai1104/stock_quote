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
                        <h1 class="h3 mb-0 text-gray-800">LeaderBoard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-trophy"></i> Leaderboard</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                      <div class="border-left-primary shadow p-3 d-flex justify-content-between">
                                        <h3>Rank</h3>
                                        <h3>User Email</h3>
                                        <h3>Balance</h3>
                                      </div>
                                      <hr>
                                      <?php
                                        $rankings = $di->get("Database")->rawQuery("SELECT * FROM `money` INNER JOIN user ON money.user_id = user.id ORDER BY balance DESC");
                                        for($i = 0; $i < count($rankings); $i++){
                                      ?>
                                        <div class="border-left-primary shadow p-3 d-flex justify-content-between">
                                          <h3><?php echo $i+1;?> <?php 
                                            if($i == 0){
                                              echo '<i class="fas fa-trophy"></i>';
                                            }
                                          ?></h3>
                                          <h3><?php echo $rankings[$i]["user_name"];?></h3>
                                          <h3>$ <?php echo $rankings[$i]["balance"];?></h3>
                                        </div>
                                      <?php } ?>
                                      <!-- <div class="shadow">
                                        <h1>hello</h1>
                                      </div> -->
                                    </div>
                                </div>
                            </div>
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

</body>

</html>