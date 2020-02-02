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
                        <div class="row" id="articles">

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

$.ajax({
    url: "https://newsapi.org/v2/everything?q=bitcoin&from=2020-01-01&sortBy=publishedAt&apiKey=afc1ce2d647d4d15a7af057132661963",
    method: "GET",
    dataType: "json",
    success: function($data) {
      $articles = $("#articles");
      for($i = 2; $i < 12; $i++){
        $articles.append('<div class="col-lg-6 mb-4" style="height: 100%"><div class="card shadow mb-4"> <div class="card-header py-3"> <h6 class="m-0 font-weight-bold text-primary">'+ $data.articles[$i]["title"] +'</h6> </div><div class="card-body"> <div class="text-center"> <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="'+ $data.articles[$i]["urlToImage"] +'" alt="Article Related Image"> </div><p>'+ $data.articles[$i]["description"] +'</p><a target="_blank" class="btn btn-primary" rel="nofollow" href="'+ $data.articles[$i]["url"] +'">Read More &rarr;</a> </div><div class="card-footer text-muted"> Posted on '+ $data.articles[$i]["publishedAt"] +' by <a href="#">'+ $data.articles[$i]["author"] +'</a> </div></div></div>');
      }
    },
    error: function(error) {
      console.log(error);
    }
  });

</script>

</body>

</html>