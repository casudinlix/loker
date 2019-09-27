@extends('admin.layouts.app')
@section('title')
  Dashboard
@endsection
@section('css')

@endsection
@section('atas')
  <ul class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li class="active">Dashboard</li>
  </ul>
@endsection

@section('content')
  <div class="row">
                          <div class="col-md-3">

                              <!-- START WIDGET SLIDER -->
                              <div class="widget widget-default widget-carousel">
                                  <div class="owl-carousel" id="owl-example">
                                      <div>
                                          <div class="widget-title">Total Visitors</div>
                                          <div class="widget-subtitle">27/08/2014 15:23</div>
                                          <div class="widget-int">3,548</div>
                                      </div>
                                      <div>
                                          <div class="widget-title">Returned</div>
                                          <div class="widget-subtitle">Visitors</div>
                                          <div class="widget-int">1,695</div>
                                      </div>
                                      <div>
                                          <div class="widget-title">New</div>
                                          <div class="widget-subtitle">Visitors</div>
                                          <div class="widget-int">1,977</div>
                                      </div>
                                  </div>
                                  <div class="widget-controls">
                                      <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                  </div>
                              </div>
                              <!-- END WIDGET SLIDER -->

                          </div>
                          <div class="col-md-3">

                              <!-- START WIDGET MESSAGES -->
                              <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                                  <div class="widget-item-left">
                                      <span class="fa fa-envelope"></span>
                                  </div>
                                  <div class="widget-data">
                                      <div class="widget-int num-count">48</div>
                                      <div class="widget-title">New messages</div>
                                      <div class="widget-subtitle">In your mailbox</div>
                                  </div>
                                  <div class="widget-controls">
                                      <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                  </div>
                              </div>
                              <!-- END WIDGET MESSAGES -->

                          </div>
                          <div class="col-md-3">

                              <!-- START WIDGET REGISTRED -->
                              <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
                                  <div class="widget-item-left">
                                      <span class="fa fa-user"></span>
                                  </div>
                                  <div class="widget-data">
                                      <div class="widget-int num-count">375</div>
                                      <div class="widget-title">Registred users</div>
                                      <div class="widget-subtitle">On your website</div>
                                  </div>
                                  <div class="widget-controls">
                                      <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                  </div>
                              </div>
                              <!-- END WIDGET REGISTRED -->

                          </div>
                          <div class="col-md-3">

                              <!-- START WIDGET CLOCK -->
                              <div class="widget widget-info widget-padding-sm">
                                  <div class="widget-big-int plugin-clock">00:00</div>
                                  <div class="widget-subtitle plugin-date">Loading...</div>
                                  <div class="widget-controls">
                                      <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                                  </div>
                                  <div class="widget-buttons widget-c3">
                                      <div class="col">
                                          <a href="#"><span class="fa fa-clock-o"></span></a>
                                      </div>
                                      <div class="col">
                                          <a href="#"><span class="fa fa-bell"></span></a>
                                      </div>
                                      <div class="col">
                                          <a href="#"><span class="fa fa-calendar"></span></a>
                                      </div>
                                  </div>
                              </div>
                              <!-- END WIDGET CLOCK -->

                          </div>
                      </div>
                      <div class="row">
    <div class="col-md-4">

        <!-- START USERS ACTIVITY BLOCK -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title-box">
                    <h3>Users Activity</h3>
                    <span>Users vs returning</span>
                </div>
                <ul class="panel-controls" style="margin-top: 2px;">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="panel-body padding-0">
                <div class="chart-holder" id="dashboard-bar-1" style="height: 200px;"></div>
            </div>
        </div>
        <!-- END USERS ACTIVITY BLOCK -->

    </div>
    <div class="col-md-4">

        <!-- START VISITORS BLOCK -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title-box">
                    <h3>Visitors</h3>
                    <span>Visitors (last month)</span>
                </div>
                <ul class="panel-controls" style="margin-top: 2px;">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="panel-body padding-0">
                <div class="chart-holder" id="dashboard-donut-1" style="height: 200px;"></div>
            </div>
        </div>
        <!-- END VISITORS BLOCK -->

    </div>

<div class="col-md-4">

        <!-- START PROJECTS BLOCK -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title-box">
                    <h3>Projects</h3>
                    <span>Projects activity</span>
                </div>
                <ul class="panel-controls" style="margin-top: 2px;">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="panel-body panel-body-table">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50%">Project</th>
                                <th width="20%">Status</th>
                                <th width="30%">Activity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Joli Admin</strong></td>
                                <td><span class="label label-danger">Developing</span></td>
                                <td>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">85%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Gemini</strong></td>
                                <td><span class="label label-warning">Updating</span></td>
                                <td>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">40%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Taurus</strong></td>
                                <td><span class="label label-warning">Updating</span></td>
                                <td>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 72%;">72%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Leo</strong></td>
                                <td><span class="label label-success">Support</span></td>
                                <td>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Virgo</strong></td>
                                <td><span class="label label-success">Support</span></td>
                                <td>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- END PROJECTS BLOCK -->

    </div>
</div>

<div class="row">
<div class="col-md-8">

        <!-- START SALES BLOCK -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title-box">
                    <h3>Sales</h3>
                    <span>Sales activity by period you selected</span>
                </div>
                <ul class="panel-controls panel-controls-title">
                    <li>
                        <div id="reportrange" class="dtrange">
                            <span></span><b class="caret"></b>
                        </div>
                    </li>
                    <li><a href="#" class="panel-fullscreen rounded"><span class="fa fa-expand"></span></a></li>
                </ul>

            </div>
            <div class="panel-body">
                <div class="row stacked">
                    <div class="col-md-4">
                        <div class="progress-list">
                            <div class="pull-left"><strong>In Queue</strong></div>
                            <div class="pull-right">75%</div>
                            <div class="progress progress-small progress-striped active">
                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">75%</div>
                            </div>
                        </div>
                        <div class="progress-list">
                            <div class="pull-left"><strong>Shipped Products</strong></div>
                            <div class="pull-right">450/500</div>
                            <div class="progress progress-small progress-striped active">
                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">90%</div>
                            </div>
                        </div>
                        <div class="progress-list">
                            <div class="pull-left"><strong class="text-danger">Returned Products</strong></div>
                            <div class="pull-right">25/500</div>
                            <div class="progress progress-small progress-striped active">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">5%</div>
                            </div>
                        </div>
                        <div class="progress-list">
                            <div class="pull-left"><strong class="text-warning">Progress Today</strong></div>
                            <div class="pull-right">75/150</div>
                            <div class="progress progress-small progress-striped active">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                            </div>
                        </div>
                        <p><span class="fa fa-warning"></span> Data update in end of each hour. You can update it manual by pressign update button</p>
                    </div>
                    <div class="col-md-8">
                        <div id="dashboard-map-seles" style="width: 100%; height: 200px"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SALES BLOCK -->

    </div>
<div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-content">
<ul class="list-inline item-details">
<li><a href="http://themifycloud.com/downloads/janux-premium-responsive-bootstrap-admin-dashboard-template/">Admin templates</a></li>
<li><a href="http://themescloud.org">Bootstrap themes</a></li>
</ul>
</div>
</div>

    <div class="col-md-4">

        <!-- START SALES & EVENTS BLOCK -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title-box">
                    <h3>Sales & Event</h3>
                    <span>Event "Purchase Button"</span>
                </div>
                <ul class="panel-controls" style="margin-top: 2px;">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="panel-body padding-0">
                <div class="chart-holder" id="dashboard-line-1" style="height: 200px;"></div>
            </div>
        </div>
        <!-- END SALES & EVENTS BLOCK -->

    </div>
</div>

  <div class="chart-holder" id="dashboard-area-1" style="height: 200px;"></div>
	<div class="block-full-width"></div>
@endsection
@section('js')
  <script type='text/javascript' src='{{asset('js/plugins/icheck/icheck.min.js')}}'></script>
          <script type="text/javascript" src="{{asset('js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>

          <script type="text/javascript" src="{{asset('js/plugins/morris/raphael-min.js')}}"></script>
          <script type="text/javascript" src="{{asset('js/plugins/morris/morris.min.js')}}"></script>
          <script type="text/javascript" src="{{asset('js/plugins/rickshaw/d3.v3.js')}}"></script>
          <script type="text/javascript" src="{{asset('js/plugins/rickshaw/rickshaw.min.js')}}"></script>
          <script type='text/javascript' src='{{asset('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}'></script>
          <script type='text/javascript' src='{{asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}'></script>
          <script type='text/javascript' src='{{asset('js/plugins/bootstrap/bootstrap-datepicker.js')}}'></script>
          <script type="text/javascript" src="{{asset('js/plugins/owl/owl.carousel.min.js')}}"></script>

          <script type="text/javascript" src="{{asset('js/plugins/moment.min.js')}}"></script>
          <script type="text/javascript" src="{{asset('js/plugins/daterangepicker/daterangepicker.js')}}"></script>
@endsection
@section('script')
<script type="text/javascript">
$(function(){
  /* reportrange */
  if($("#reportrange").length > 0){
      $("#reportrange").daterangepicker({
          ranges: {
             'Today': [moment(), moment()],
             'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
             'This Month': [moment().startOf('month'), moment().endOf('month')],
             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM.DD.YYYY',
          separator: ' to ',
          startDate: moment().subtract('days', 29),
          endDate: moment()
        },function(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      });

      $("#reportrange span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
  }
  /* end reportrange */

  /* Rickshaw dashboard chart */
  // var seriesData = [ [], [] ];
  // var random = new Rickshaw.Fixtures.RandomData(1000);

  // for(var i = 0; i < 100; i++) {
      // random.addData(seriesData);
  // }

  // var rdc = new Rickshaw.Graph( {
          // element: document.getElementById("dashboard-chart"),
          // renderer: 'area',
          // width: $("#dashboard-chart").width(),
          // height: 250,
          // series: [{color: "#33414E",data: seriesData[0],name: 'New'},
                   // {color: "#1caf9a",data: seriesData[1],name: 'Returned'}]
  // } );

  // rdc.render();

  // var legend = new Rickshaw.Graph.Legend({graph: rdc, element: document.getElementById('dashboard-legend')});
  // var shelving = new Rickshaw.Graph.Behavior.Series.Toggle({graph: rdc,legend: legend});
  // var order = new Rickshaw.Graph.Behavior.Series.Order({graph: rdc,legend: legend});
  // var highlight = new Rickshaw.Graph.Behavior.Series.Highlight( {graph: rdc,legend: legend} );

  // var rdc_resize = function() {
          // rdc.configure({
                  // width: $("#dashboard-area-1").width(),
                  // height: $("#dashboard-area-1").height()
          // });
          // rdc.render();
  // }

  // var hoverDetail = new Rickshaw.Graph.HoverDetail({graph: rdc});

  // window.addEventListener('resize', rdc_resize);

  // rdc_resize();
  /* END Rickshaw dashboard chart */

  /* Donut dashboard chart */
  Morris.Donut({
      element: 'dashboard-donut-1',
      data: [
          {label: "Returned", value: 2513},
          {label: "New", value: 764},
          {label: "Registred", value: 311}
      ],
      colors: ['#33414E', '#1caf9a', '#FEA223'],
      resize: true
  });
  /* END Donut dashboard chart */


  /* Bar dashboard chart */
  Morris.Bar({
      element: 'dashboard-bar-1',
      data: [
          { y: 'Oct 10', a: 75, b: 35 },
          { y: 'Oct 11', a: 64, b: 26 },
          { y: 'Oct 12', a: 78, b: 39 },
          { y: 'Oct 13', a: 82, b: 34 },
          { y: 'Oct 14', a: 86, b: 39 },
          { y: 'Oct 15', a: 94, b: 40 },
          { y: 'Oct 16', a: 96, b: 41 }
      ],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['New Users', 'Returned'],
      barColors: ['#33414E', '#1caf9a'],
      gridTextSize: '10px',
      hideHover: true,
      resize: true,
      gridLineColor: '#E5E5E5'
  });
  /* END Bar dashboard chart */

  /* Line dashboard chart */
  Morris.Line({
    element: 'dashboard-line-1',
    data: [
      { y: '2014-10-10', a: 2,b: 4},
      { y: '2014-10-11', a: 4,b: 6},
      { y: '2014-10-12', a: 7,b: 10},
      { y: '2014-10-13', a: 5,b: 7},
      { y: '2014-10-14', a: 6,b: 9},
      { y: '2014-10-15', a: 9,b: 12},
      { y: '2014-10-16', a: 18,b: 20}
    ],
    xkey: 'y',
    ykeys: ['a','b'],
    labels: ['Sales','Event'],
    resize: true,
    hideHover: true,
    xLabels: 'day',
    gridTextSize: '10px',
    lineColors: ['#1caf9a','#33414E'],
    gridLineColor: '#E5E5E5'
  });
  /* EMD Line dashboard chart */
  /* Moris Area Chart */
    Morris.Area({
    element: 'dashboard-area-1',
    data: [
      { y: '2014-10-10', a: 17,b: 19},
      { y: '2014-10-11', a: 19,b: 21},
      { y: '2014-10-12', a: 22,b: 25},
      { y: '2014-10-13', a: 20,b: 22},
      { y: '2014-10-14', a: 21,b: 24},
      { y: '2014-10-15', a: 34,b: 37},
      { y: '2014-10-16', a: 43,b: 45}
    ],
    xkey: 'y',
    ykeys: ['a','b'],
    labels: ['Sales','Event'],
    resize: true,
    hideHover: true,
    xLabels: 'day',
    gridTextSize: '10px',
    lineColors: ['#1caf9a','#33414E'],
    gridLineColor: '#E5E5E5'
  });
  /* End Moris Area Chart */
  /* Vector Map */
  var jvm_wm = new jvm.WorldMap({container: $('#dashboard-map-seles'),
                                  map: 'world_mill_en',
                                  backgroundColor: '#FFFFFF',
                                  regionsSelectable: true,
                                  regionStyle: {selected: {fill: '#B64645'},
                                                  initial: {fill: '#33414E'}},
                                  markerStyle: {initial: {fill: '#1caf9a',
                                                 stroke: '#1caf9a'}},
                                  markers: [{latLng: [50.27, 30.31], name: 'Kyiv - 1'},
                                            {latLng: [52.52, 13.40], name: 'Berlin - 2'},
                                            {latLng: [48.85, 2.35], name: 'Paris - 1'},
                                            {latLng: [51.51, -0.13], name: 'London - 3'},
                                            {latLng: [40.71, -74.00], name: 'New York - 5'},
                                            {latLng: [35.38, 139.69], name: 'Tokyo - 12'},
                                            {latLng: [37.78, -122.41], name: 'San Francisco - 8'},
                                            {latLng: [28.61, 77.20], name: 'New Delhi - 4'},
                                            {latLng: [39.91, 116.39], name: 'Beijing - 3'}]
                              });
  /* END Vector Map */


  $(".x-navigation-minimize").on("click",function(){
      setTimeout(function(){
          rdc_resize();
      },200);
  });


});

</script>
@endsection
