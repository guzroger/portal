<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

        <style>
            body 
            {
              background-color: #ffffff;
            }
        </style>
    </head>

    <body>

        <div id="wrapper">
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">       
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="card-box">
                                    <h4 class="header-title">Plataforma de Activación de Cupones</h4>
                                    <p class="sub-header">
                                        Ingrese el número Documento/Nit [sin extension] del Titular del Servicio<br> 
                                        <kbd>* Campo Obligatorio</kbd>
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <FORM action="data_controller.php" method="POST" id="PersonForm">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="example-number">Nro. Documento de Identidad
                                                                <font color="#000">[*]</font></label> 
                                                                <input id="nit_ci" name="nit_ci" type="text" class="form-control" required placeholder="Numero de Documento de Identidad"/>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <button type="submit" class="btn btn-dark">Buscar&nbsp;&nbsp;<i class="fe-search"></i></button>
                                                            </div>
                                                        </div>
                                                    </FORM>
                                                </td>
                                                <td>
                                                    <img src="img/datdata.png">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END wrapper -->



        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>
        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>