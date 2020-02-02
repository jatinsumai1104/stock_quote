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
        $articles.append('<div class="card mb-12 mb-5"> <img class="card-img-top"  src="'+ $data.articles[$i]["urlToImage"] +'" alt="Card image cap"> <div class="card-body"> <h2 class="card-title">'+ $data.articles[$i]["title"] +'</h2> <p class="card-text">'+ $data.articles[$i]["content"] +'</p> </div><div class="card-footer text-muted"> Posted on '+ $data.articles[$i]["publishedAt"] +' by <a href="#">'+ $data.articles[$i]["author"] +'</a> </div></div></div>');
      }
    },
    error: function(error) {
      console.log(error);
    }
  });

</script>

</body>

</html>