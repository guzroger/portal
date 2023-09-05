<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl;?>/images/com.ico">
        <!-- Plugins css-->
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
        <!-- Dropzone css -->
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/dropzone/dropzone.css" rel="stylesheet" />
        <!--calendar css-->
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />


        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/jquery-circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/sweet-alert/sweetalert2.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- DataTables -->
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Multi Item Selection examples -->
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!--MY CSS STYLE-->
        <link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/mystyle.css" rel="stylesheet" type="text/css" />

        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/modernizr.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/ckeditor/ckeditor.js"></script>
        <!-- BEGIN PAGE SCRIPTS -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/moment/moment.js"></script>
        <script src='<?php echo Yii::app()->theme->baseUrl;?>/plugins/fullcalendar/js/fullcalendar.min.js'></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/pages/jquery.fullcalendar.js"></script>
        <script src="<?php echo Yii::app()->createUrl('main/directory')?>"></script>

        <style type="text/css">
            .loader_div{
                position: absolute;
                top: 0;
                bottom: 0%;
                left: 0;
                right: 0%;
                z-index: 99;
                opacity:0.8;
                display:none;
                background: white url('images/load.gif') center 300px no-repeat;
            }
        </style>
    </head>

    <body>
        <div id="loader_div" class="loader_div"></div>
        <script type="text/javascript">
            jQuery('.loader_div').show();
        </script>
        <!-- Navigation Bar-->
        <header id="topnav">
            <?php $this->renderPartial('//options/header'); ?>
            <?php $this->renderPartial('//options/menu'); ?>
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title"><?php echo CHtml::encode($this->pageTitle); ?></h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->
                <?php echo $content; ?>
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


        <!-- Footer -->
        <footer class="footer">
            <?php $this->renderPartial('//options/footer'); ?>
        </footer>
        <!-- End Footer -->


        <!-- jQuery  -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/popper.min.js"></script><!-- Popper for Bootstrap --><!-- Tether for Bootstrap -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/waves.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.scrollTo.min.js"></script>

        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/switchery/switchery.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>

        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/moment/moment.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>


        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>

        <!-- Dropzone js -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/dropzone/dropzone.js"></script>
        

        <!-- Counter Up  -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- circliful Chart -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/jquery-circliful/js/jquery.circliful.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!-- skycons -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/skyicons/skycons.min.js" type="text/javascript"></script>

        <!-- Page js  -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/pages/jquery.dashboard.js"></script>
        <!-- Modal-Effect -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/custombox/dist/custombox.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/custombox/dist/legacy.min.js"></script>

        <!-- Sweet Alerts js -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/sweet-alert/sweetalert2.min.js"></script>

        <!-- Custom main Js -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.core.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.app.js"></script>

        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/pages/jquery.form-advanced.init.js"></script>


        <!-- Required datatable js -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/jszip.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/vfs_fonts.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/buttons.print.min.js"></script>

        <!-- Key Tables -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/dataTables.keyTable.min.js"></script>

        <!-- Responsive examples -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Selection table -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/datatables/dataTables.select.min.js"></script>
        
        <!-- Gallery js -->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/isotope/dist/isotope.pkgd.min.js"></script>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
                $('.circliful-chart').circliful();
            });

            // BEGIN SVG WEATHER ICON
            if (typeof Skycons !== 'undefined'){
                var icons = new Skycons(
                        {"color": "#3bafda"},
                        {"resizeClear": true}
                        ),
                        list  = [
                            "clear-day", "clear-night", "partly-cloudy-day",
                            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                            "fog"
                        ],
                        i;

                for(i = list.length; i--; )
                    icons.set(list[i], list[i]);
                icons.play();
            };

        </script>
        <script type="text/javascript">
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
            window.addEventListener('load', function () {
                jQuery('.loader_div').hide();
            })
        </script>
        <script type="text/javascript">
            $(document).ready(function() {

                // Default Datatable
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                    lengthChange: true,
                    responsive: true,
                    buttons: [
                        { extend: 'copy', text: 'Copiar',exportOptions: {columns: ":visible"} }, 
                        { extend: 'excel', text: 'Excel',exportOptions: {columns: ":visible"} }, 
                        { extend: 'pdf', text: 'PDF',exportOptions: {columns: ":visible"} }
                    ],
                    order: [[ 0, "desc" ]],
                    columnDefs: [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],                                
                    language: {
                        "sLengthMenu": "Mostrar _MENU_ Resultados",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "_START_ al _END_ de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 - 0 de 0",
                        "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                            "sLast": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                            "sNext": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                            "sPrevious": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                        },
                        "sProcessing": "Procesando...",
                    }
                });

                var tableSecond = $('#datatable-buttons-second').DataTable({
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                    lengthChange: true,
                    responsive: true,
                    buttons: [
                        { extend: 'copy', text: 'Copiar',exportOptions: {columns: ":visible"} }, 
                        { extend: 'excel', text: 'Excel',exportOptions: {columns: ":visible"} }, 
                        { extend: 'pdf', text: 'PDF',exportOptions: {columns: ":visible"} }
                    ],
                    order: [[ 0, "desc" ]],
                    columnDefs: [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],                                
                    language: {
                        "sLengthMenu": "Mostrar _MENU_ Resultados",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "_START_ al _END_ de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 - 0 de 0",
                        "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                            "sLast": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                            "sNext": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                            "sPrevious": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                        },
                        "sProcessing": "Procesando...",
                    }
                });

                var tableTres = $('#datatable-buttons-thrid').DataTable({
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                    lengthChange: true,
                    responsive: true,
                    buttons: [
                        { extend: 'copy', text: 'Copiar',exportOptions: {columns: ":visible"} }, 
                        { extend: 'excel', text: 'Excel',exportOptions: {columns: ":visible"} }, 
                        { extend: 'pdf', text: 'PDF',exportOptions: {columns: ":visible"} }
                    ],
                    order: [[ 0, "desc" ]],
                    columnDefs: [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                            "searchable": false
                        }
                    ],                                
                    language: {
                        "sLengthMenu": "Mostrar _MENU_ Resultados",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "_START_ al _END_ de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 - 0 de 0",
                        "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                            "sLast": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                            "sNext": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                            "sPrevious": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                        },
                        "sProcessing": "Procesando...",
                    }
                });

                // Key Tables

                $('#key-table').DataTable({
                    keys: true
                });

                // Responsive Datatable
                $('#responsive-datatable').DataTable();

                // Multi Selection Datatable
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });

                table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

                tableSecond.buttons().container().appendTo('#datatable-buttons-second_wrapper .col-md-6:eq(0)');

                tableTres.buttons().container().appendTo('#datatable-buttons-thrid_wrapper .col-md-6:eq(0)');

            } );

        </script>
    </body>
</html>