<!DOCTYPE html>
<html style="background:white;">
    <head>
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl;?>/images/com.ico">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/plugins/morris/morris.css">

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

        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/modernizr.min.js"></script>
        <!-- jQuery  -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/popper.min.js"></script><!-- Popper for Bootstrap --><!-- Tether for Bootstrap -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/waves.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.scrollTo.min.js"></script>

        <!--Morris Chart-->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/morris/morris.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/plugins/raphael/raphael-min.js"></script>

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
        <!-- App js -->
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.core.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.app.js"></script>
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
              background: white url('images/load.gif') center 100px no-repeat;
          }
      </style>
    </head>

    <body style="background:white;">
        <div id="loader_div" class="loader_div"></div>
        <script type="text/javascript">
            jQuery('.loader_div').show();
        </script>
        <div class="wrapper">
            <div class="container-fluid">
                    <?php echo $content; ?>
            </div> 
            <!-- end container -->
        </div>
        <!-- Footer -->
        <footer class="footer">
            <?php $this->renderPartial('//options/footer'); ?>
        </footer>
        <!-- End Footer -->
        <script type="text/javascript">
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
            window.addEventListener('load', function () {
                jQuery('.loader_div').hide();
            })
        </script>
    </body>
</html>