<script>
  var uxTour = new uxTour();
  var tour = {
    steps: [
      {
        element: 'watch_list',
        text: '<h1>This is Watch List</h1>'
      },{
        element: 'add-watch-list',
        text: 'Here you create your watch list'
      }
    ]
  };
  uxTour.start(tour);
</script>