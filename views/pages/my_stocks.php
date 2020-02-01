
<?php
require_once('../../helper/constants.php');
require_once(__DIR__.'/../../helper/init.php');
$di->get("Database");
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
                        <h1 class="h3 mb-0 text-gray-800">My Stock</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="container-fluid">
                      <table class="table table-bordered">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Stock Name</th>
                            <th scope="col">Delivery Type</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Buy</th>
                            <th scope="col">Sell</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $stocks = $di->get("Stock")->getStocksQuantity(Session::getSession("user_id"));
                            var_dump($stocks);
                            foreach($stocks as $stock){
                          ?>
                          <tr>
                            <th scope="row"><?php echo $stock["stock_name"]?></th>
                            <td><?php echo $stock["quantity"]?></td>
                            <td><?php echo $stock["delivery_type"]?></td>
                            <td><a href="" class="btn btn-success" style="width:100%">Buy</a></td>
                            <td><a href="" class="btn btn-danger" style="width:100%">Sell</a></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
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