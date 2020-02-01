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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>
            <!-- Earnings (Monthly) Card Example -->
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Stock Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Status</th>
      <th scope="col">Buy/Sell</th>
      <th scope="col">Price</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
    <?php
        $result = $di->get("TransactionHistory")->getHistory(Session::getSession("user_id"));
        $i=0;
        foreach($result as $res){
            $res = $result[$i];
    ?>
    <tr>
    <th scope="row"><?php  echo $i+1 ?></th>
    <th><?php  echo $res['stock_name']?></th>
    <th><?php echo $res['quantity']?></th>
    <th><?php if($res['transaction_status'] == 1){echo "closed";}else{echo "open";}?></th>
    <th><?php if($res['buy_sell']==0){echo "buy";}else{echo "sell";}?></th>
    <th><?php echo $res['price'];?></th>
    <th><?php echo $res['transaction_date'];?></th>
    </tr>
        <?php $i++;}?>
  </tbody>
</table>
    
            




          <!-- Content Row -->
          

        <!-- </div> -->
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