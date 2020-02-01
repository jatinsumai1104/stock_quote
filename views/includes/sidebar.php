<?php 
  if(Session::getSession("user_id") == null){
    Util::redirect("login");
  }
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo BASEPAGES?>index.php">
  <!-- <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div> -->
  <div class="sidebar-brand-text mx-3 d-flex"><img src="<?php echo BASEASSETS;?>img/logo-5.png" class="img-fluid" alt="" width="50px">Stock Quote</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="<?php echo BASEPAGES?>index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product" aria-expanded="true" aria-controls="product">
    <i class="fas fa-fw fa-list"></i>
    <span>Watch List</span>
  </a>
  <div id="product" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a href="<?php echo BASEPAGES?>add-watch-list.php" class="collapse-item"><i class="fas fa-plus"></i> Add Watch List</a>
      <?php 
        $data = $di->get("WatchList")->getAllWatchList();
        foreach($data as $list){
      ?>
        <a class="collapse-item" href="<?php echo BASEPAGES?>watch-list-stocks.php?watch_list=<?php echo $list["id"]?>"><?php echo $list["watch_list_name"]?> </a>
      <?php } ?>
    </div>
  </div>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#buy_sell" aria-expanded="true" aria-controls="product">
    <i class="fas fa-fw fa-wallet"></i>
    <span>Buy-sell Pages</span>
  </a>
  <div id="buy_sell" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a href="<?php echo BASEPAGES?>add-buy.php" class="collapse-item"><i class="fas fa-plus"></i> Buy Page</a>
      <a href="<?php echo BASEPAGES?>add-sales.php" class="collapse-item"><i class="fas fa-plus"></i> Sell Page</a>
    </div>
  </div>
</li>

<li class="nav-item active">
  <a class="nav-link" href="<?php echo BASEPAGES?>index.php">
    <i class="fas fa-fw fa-trophy"></i>
    <span>LeaderBoard</span></a>
</li>
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaction_history" aria-expanded="true" aria-controls="product">
    <i class="fas fa-fw fa-history"></i>
    <span>Transaction History</span>
  </a>
  <div id="transaction_history" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a href="<?php echo BASEPAGES?>transaction-history.php" class="collapse-item"><i class="fas fa-plus"></i> All Transactions</a>
      <a href="<?php echo BASEPAGES?>transaction-history-open.php" class="collapse-item"><i class="fas fa-plus"></i> Open Transactions</a>
      <a href="<?php echo BASEPAGES?>transaction-history-closed.php" class="collapse-item"><i class="fas fa-plus"></i> Closed Transactions</a>
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->