
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
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-around">
              <h2 class="m-0 font-weight-bold text-primary"> Nifty -2.0</h2>
            </div>
            <div class="card-body py-3" style="height:800px">
              <div id="chartdiv" style="height:80%"></div>
              <div class="row">
                <div class="col-md-6 border">Open <span class="float-right">100</span></div>
                <div class="col-md-6 border">Low <span class="float-right">100</span></div>
                <div class="col-md-6 border">High <span class="float-right">100</span></div>
                <div class="col-md-6 border">Close <span class="float-right">100</span></div>
                <div class="col-md-6 border">52 Wk High <span class="float-right">100</span></div>
                <div class="col-md-6 border">52 Wk Low <span class="float-right">100</span></div>
              </div>
            </div>
          </div>
          <!-- Content Row -->
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <div class="buy_sell_button d-flex justify-content-between container">
        <a class="d-sm-inline-block btn btn-success shadow-sm mr-3" data-toggle="tab" href="#disabilities" role="tab" aria-controls="disabilities" aria-selected="true" style="z-index:1000;width:40%"><i class="fa fa-shopping-cart pr-2" aria-hidden="true"></i>Buy</a>
        <a class="d-sm-inline-block btn btn-danger shadow-sm mr-3" data-toggle="tab" href="#disabilities" role="tab" aria-controls="disabilities" aria-selected="true" style="z-index:1000;width:40%"><i class="fa fa-book-dead pr-2" aria-hidden="true"></i>Sell</a>
      </div>
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
  </script>

  <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/dataviz.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<!-- Chart code -->
<script>
  am4core.ready(function() {

  // Themes begin
  am4core.useTheme(am4themes_dataviz);
  am4core.useTheme(am4themes_animated);
  // Themes end

  var chart = am4core.create("chartdiv", am4charts.XYChart);
  chart.paddingRight = 20;

  chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

  var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
  dateAxis.renderer.grid.template.location = 0;

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.tooltip.disabled = true;

  var series = chart.series.push(new am4charts.CandlestickSeries());
  series.dataFields.dateX = "date";
  series.dataFields.valueY = "close";
  series.dataFields.openValueY = "open";
  series.dataFields.lowValueY = "low";
  series.dataFields.highValueY = "high";
  series.simplifiedProcessing = true;
  series.tooltipText = "Open:${openValueY.value}\nLow:${lowValueY.value}\nHigh:${highValueY.value}\nClose:${valueY.value}";

  chart.cursor = new am4charts.XYCursor();

  // a separate series for scrollbar
  var lineSeries = chart.series.push(new am4charts.LineSeries());
  lineSeries.dataFields.dateX = "date";
  lineSeries.dataFields.valueY = "close";
  // need to set on default state, as initially series is "show"
  lineSeries.defaultState.properties.visible = false;

  // hide from legend too (in case there is one)
  lineSeries.hiddenInLegend = true;
  lineSeries.fillOpacity = 0.5;
  lineSeries.strokeOpacity = 0.5;

  var scrollbarX = new am4charts.XYChartScrollbar();
  scrollbarX.series.push(lineSeries);
  chart.scrollbarX = scrollbarX;

  $.getJSON("https://api.worldtradingdata.com/api/v1/history?symbol=SNAP&api_token=KbzMvegVlq6PGIszedPEvD4R73NrKnhdlVur1JuLzxA2yrza9KKe8tzxGyUd", parseData);    
  // chart.data = [];
  function parseData(result){        
      var index = [];
      for (var i in result.history) {
          index.push(i);        
      }
      d = [];
      // console.log(result);
      for(i=0;i<index.length;i++){
          d.push({
              "date": index[i],
              "open": result.history[index[i]].open,
              "high": result.history[index[i]].high,
              "low": result.history[index[i]].low,
              "close":result.history[index[i]].close
          });
      }
      chart.data = d;
  }

  });
</script>
</body>
</html>