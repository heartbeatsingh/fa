<!DOCTYPE html>
<html lang="en-us">
    <head>
        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        @include('admin.partials.head')

    </head>
    <body class="hold-transition skin-blue sidebar-mini desktop-detected smart-style-3">
        <header id="header" style="background: #058DC7; padding-top: 10px;height: 100px !important;">

            @include('admin.partials.header')

        </header>  
        <aside id="left-panel" style="top: 50px;background: #785CB4">
            @include('admin.partials.navbar') 
        </aside>
        <div id="main" role="main">
            <!-- MAIN CONTENT -->
            <div id="content">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> {{ Session::get('success') }}
                </div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Danger!</strong> {{ Session::get('error') }}
                </div>
                @endif

                @yield('content')
            </div>
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN PANEL -->
        <!-- /.content-wrapper -->
        @include('admin.partials.footer')



        <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
        <script data-pace-options='{ "restartOnRequestAfter": true }' src="{{ URL::to('/') }}/public/admin/js/plugin/pace/pace.min.js"></script>


        <script>
            if (!window.jQuery) {
                document.write('<script src="js/libs/jquery-2.0.2.min.js"><\/script>');
            }
        </script>

        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script>
            if (!window.jQuery.ui) {
                document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
            }
        </script>

        <!-- IMPORTANT: APP CONFIG -->
        <script src="{{ URL::to('/') }}/public/admin/js/app.config.js"></script>

        <!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 

        <!-- BOOTSTRAP JS -->
        <script src="{{ URL::to('/') }}/public/admin/js/bootstrap/bootstrap.min.js"></script>

        <!-- CUSTOM NOTIFICATION -->
        <script src="{{ URL::to('/') }}/public/admin/js/notification/SmartNotification.min.js"></script>

        <!-- JARVIS WIDGETS -->
        <script src="{{ URL::to('/') }}/public/admin/js/smartwidgets/jarvis.widget.min.js"></script>

        <!-- EASY PIE CHARTS -->
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

        <!-- SPARKLINES -->
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/sparkline/jquery.sparkline.min.js"></script>

        <!-- JQUERY VALIDATE -->
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/jquery-validate/jquery.validate.min.js"></script>

        <!-- JQUERY MASKED INPUT -->
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

        <!-- JQUERY SELECT2 INPUT -->
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/select2/select2.min.js"></script>

        <!-- JQUERY UI + Bootstrap Slider -->
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

        <!-- browser msie issue fix -->
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

        <!-- FastClick: For mobile devices -->
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/fastclick/fastclick.min.js"></script>

        <!--[if IE 8]>

        <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

        <![endif]-->

    

        <!-- MAIN APP JS FILE -->
        <script src="{{ URL::to('/') }}/public/admin/js/app.min.js"></script>

        <!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
        <!-- Voice command : plugin -->
        <script src="{{ URL::to('/') }}/public/admin/js/speech/voicecommand.min.js"></script>

        <!-- PAGE RELATED PLUGIN(S) 
        <script src="..."></script>-->


        <script src="{{ URL::to('/') }}/public/admin/js/plugin/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/datatables/dataTables.colVis.min.js"></script>
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/datatables/dataTables.tableTools.min.js"></script>
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
        <script src="{{ URL::to('/') }}/public/admin/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>



        <script type="text/javascript">

            $(document).ready(function () {
                var responsiveHelper_dt_basic = undefined;
                var breakpointDefinition = {
                    tablet: 1024,
                    phone: 480
                };
                $('#dt_basic').dataTable({
                    "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                            "t" +
                            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                    "autoWidth": true,
                    "order": [[0, 'desc']],
                    "preDrawCallback": function () {
                        // Initialize the responsive datatables helper once.
                        if (!responsiveHelper_dt_basic) {
                            responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                        }
                    },
                    "rowCallback": function (nRow) {
                        responsiveHelper_dt_basic.createExpandIcon(nRow);
                    },
                    "drawCallback": function (oSettings) {
                        responsiveHelper_dt_basic.respond();
                    }
                });
            })
        </script>


        @yield('scripts')
    </body>

</html>