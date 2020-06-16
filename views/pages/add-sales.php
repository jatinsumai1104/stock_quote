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
                        <h1 class="h3 mb-0 text-gray-800">Buy Stock</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus"></i> Add
                                            Stock</h6>
                                    </div>
                                    <!-- Card Body -->
                            <form action="<?php echo BASEURL?>helper/routing.php" method="POST">
                                        <input type="hidden" name="csrf_token" id="csrf_token"
                                            value=<?php echo Session::getSession("csrf_token");?>>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Stock Name</label>
                                                        <input type="text" class="form-control" name="stock_name"
                                                            aria-describedby="helpId" placeholder="" value="<?php  echo $_GET['symbol']?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">PRICE</label>
                                                        <input type="text" class="form-control" name="stock_price"
                                                             aria-describedby="helpId" placeholder="" value="<?php echo $_GET['price']?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <h3 for="">Intraday</h3>
                                                        
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Quantity Intraday</label>
                                                        <?php
                                                        $user_id = Session::getSession("user_id");
                                                        $symbol = $_GET['symbol'];
                                                        $query="SELECT * FROM stock_intraday WHERE user_id={$user_id} and stock_name='{$symbol}'";
                                                        //echo $query;
                                                        $res = $di->get("Database")->rawQuery($query);
                                                        if(count($res) > 0){
                                                        ?>

                                                        <input type="text" class="form-control" name="quantity" 
                                                            aria-describedby="helpId" placeholder="" value="<?php echo $res[0]["quantity"]?>" disabled>

                                                          
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <input type="text" class="form-control" name="quantity" 
                                                            aria-describedby="helpId" placeholder="" value="0" disabled>
                                                            <?php }?>
                                                    </div>

                                                    <div class="form-group">
                                                        <h3 for="">Delivery</h3>
                                                        
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Quantity Delivery</label>
                                                        <?php
                                                        $user_id = Session::getSession("user_id");
                                                        $symbol = $_GET['symbol'];
                                                        $query="SELECT * FROM stock_delivery WHERE user_id={$user_id} and stock_name='{$symbol}'";
                                                        $res = $di->get("Database")->rawQuery($query);
                                                        if(count($res) > 0){
                                                        ?>
                                                        <input type="text" class="form-control" name="quantity" 
                                                            aria-describedby="helpId" placeholder="" value="<?php echo $res[0]["quantity"]?>">
                                                            
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <input type="text" class="form-control" name="quantity" 
                                                            aria-describedby="helpId" placeholder="" value="0" disabled>
                                                            <?php }?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Choose Type</label>
                                                        <select name="order_type" 
                                                            class="form-control">
                                                            <option value="Intraday">Intraday</option>
                                                            <option value="Delivery">Delivery</option>
                                                        </select>
                                                    </div>
                                                    

                                           <input type="hidden" value="<?php echo $_GET['price'] ?>" name="realtime_price"> 

                                     <button type="submit" class="btn btn-primary" name="sellStock">Sell Stock</button>

                                                 </div>
                                    <div class="col-md-6">

                                    <div class="form-group">
                                                        <label for="">Order Complexity</label>
                                                        <select name="order_complexity" 
                                                            class="form-control">
                                                            <option value="Simple">Simple</option>
                                                            <option value="CO">CO</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Transaction Period</label>
                                                        <select name="intra_delivery"
                                                            class="form-control">
                                                            <option value="Intraday">IntraDay</option>
                                                            <option value="Delivery">Delivery</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Choose Transaction type</label>
                                                        <select name="transaction_price_type" id="order_transaction_type"
                                                            class="form-control">
                                                            <option value="Market">Market</option>
                                                            <option value="Limit">Limit</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" id="trigger_label"></label>
                                                        <div id="hidden">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Quantity to sell</label>
                                                        <input type="text" name="sell_quantity">
                                                    </div>             

                                    </div>

                            </form>
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
<script src="<?php echo BASEASSETS; ?>js/add-sales.js"></script>
</html>