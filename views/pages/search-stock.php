
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
            <h1 class="h3 mb-0 text-gray-800">Add Stock</h1>
          </div>
            <!-- <input type="text" id="search-text">
            <input type="submit" id="search">   -->
            <div class="form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search mb-5">
              <div class="input-group">
                <input type="text" id="search-text" class="form-control bg-light border-0 small" placeholder="Search Stock..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button" id="search">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </div>
          <!-- Content Row -->
          <!-- <div class="row"> -->
            <div id="elements" class="card shadow mb-4 mt-4">
            </div>
            <!-- Earnings (Monthly) Card Example -->
            
            
            




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
    <script>
        $("#search").click(function(){
            text = $("#search-text").val();
            $.ajax({
            url: "https://api.worldtradingdata.com/api/v1/stock?symbol="+text+"&api_token=KbzMvegVlq6PGIszedPEvD4R73NrKnhdlVur1JuLzxA2yrza9KKe8tzxGyUd",
            method: "GET",
            dataType: "json",
            success: function(data) {
                $("#elements ").empty();
                for(i=0;i<data.data.length;i++){
                    $("#elements").append("<div class='card-header py-3 d-flex justify-content-around'> <h2 class='m-0 font-weight-bold text-primary'> "+data.data[i].symbol +"<small>"+data.data[i].name+"</small> </h2> <form action='<?php echo BASEURL?>helper/routing.php' method='post'><input type='text' value='<?php echo $_GET['watch_list']?>' name='watch_list' hidden><input type='text' value='"+data.data[i].symbol+"' hidden name='symbol'> <input type='submit' class='d-sm-inline-block btn btn-dark shadow-sm mr-3' value='Add' name='add_watch'> </form></div>");
                    
                }
                
            },
            error: function(error) {
              console.log(error);
            }
          });
        });
    
    </script>
</body>
</html>