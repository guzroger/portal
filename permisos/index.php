<!DOCTYPE html>

<html>

<head>
  <title>COMTECO R.L.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Sistema de Registro Salida Temporal" name="Helvin Guzman" />
        <meta content="SALIDAS" name="COMTECO R.L." />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
        <!-- third party css -->
        <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <script src="assets/js/vendor.min.js"></script>

        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

<style>
    html, body{
        height:100%;
        }
    body{
        /*background:#283593;*/
        background:#b9b9b9;
        display:flex;
        justify-content:center;
        align-items:center;
        max-width:1200px;
        margin:0 auto;
        }

        .loader_div{
            position: fixed;
            top: 0;
            bottom: 0%;
            left: 0;
            right: 0%;
            z-index: 1000000000;
            opacity:0.8;
            display:block;
            background: white url('assets/images/Curve-Loading.gif') center 150px no-repeat;
        }

    #signin{
        width:60%;
        /*background:#3F51B5;*/
        background:#3E3E3E;
        margin:100px 50px;
        box-shadow:0 0 64px rgba(0,0,0,0.5);
        padding:100px;
        position:relative;
        overflow:hidden;
        }
    #signin .form-title{font:500 16px/1 'Roboto',sans-serif; color:#EBEBEB; text-align:center; margin:35px 0;}

    #signin .input-field{position:relative; height:50px; margin:35px 0; transition:all 300ms; width: 110%; }
    #signin .input-field i{position:absolute; bottom:28px; left:15px; color:#BBBBBB; height:0; visibility:hidden; font-size:100%; transition:height 250ms;}
    #signin .input-field label{width:100%; height:100%; position:absolute; margin-top:20px; left:4px; font:400 16px/1 'Roboto',sans-serif; color:#FFF; opacity:1; transition:all 300ms;}
    #signin .input-field input{width:calc(100% - 70px); height:4px; font:500 16px/1 'Roboto',sans-serif; padding:0 20px 0 50px; border:none; box-shadow:0 10px 10px rgba(0,0,0,0.25); color:#606060; border-radius:6px; outline:0; overflow:hidden; position:absolute; bottom:0; left:0; transition:all 300ms;}

    #signin .forgot-pw{font:600 14px/1 'Roboto',sans-serif; color:#2E3C89; text-decoration:none; float:right; margin:0 0 25px 0; display:block;}

    #signin button.login{
        min-height:60px;
        font:500 20px/1 'Roboto',sans-serif;
        width:100%;
        padding:20px;
        display:block;
        /*background:#324192; */
        background:#e30303;
        color:#FFF;
        border:none;
        outline:0;
        cursor:pointer;
        position:absolute;
        left:0;
        bottom:0;
        }

    #signin button.return{
        min-height:60px;
        font:500 20px/1 'Roboto',sans-serif;
        width:100%;
        padding:20px;
        display:block;
        /*background:#324192; */
        background:#e30303;
        color:#FFF;
        border:none;
        outline:0;
        cursor:pointer;
        position:absolute;
        left:0;
        bottom:0;
        }

    #signin button.registrar{
        min-height:60px;
        font:500 20px/1 'Roboto',sans-serif;
        width:100%;
        padding:20px;
        display:block;
        /*background:#324192; */
        background:#e30303;
        color:#FFF;
        border:none;
        outline:0;
        cursor:pointer;
        position:absolute;
        left:0;
        bottom:0;
        }

    #signin .check{
        width:100%;
        height:100%;
        /*background:#324192;*/
        background:#3E3E3E;
        position:absolute;
        top:100%; left:0;
        text-align:center;
        visibility:hidden;
        transition:all 1s;
        }

    #signin .check.in{visibility:visible; top:0;}
    #signin .check.out{visibility:hidden; top:0;}

    #signin .check i{color:#FFF; font-size:36px; line-height:1.4;}

    /**/
    #signin .check2{
        width:100%;
        height:100%;
        /*background:#324192;*/
        background:#3E3E3E;
        position:absolute;
        top:100%; left:0;
        text-align:center;
        visibility:hidden;
        transition:all 1s;
        }

    #signin .check2.in{visibility:visible; top:0;}
    #signin .check2.out{visibility:hidden; top:0;}

    #signin .check2 i{color:#FFF; font-size:36px; line-height:1.4;}
    /**/


    #signin .input-field input:focus{color:#333;}
    #signin .input-field input:focus, #signin .input-field input.not-empty{height:auto; padding:14px 20px 14px 50px;}
    #signin .input-field input:focus + i, #signin .input-field input.not-empty + i{font-size:24px; bottom:26px; height:10px; visibility:visible;}
    #signin .input-field input:focus + i + label, #signin .input-field input.not-empty + i + label{font-size:12px; margin-top:-15px; opacity:0.7; animation:label 300ms 1;}

    @keyframes label{
    	0%{margin-top:-15px;}
    	50%{margin-top:-25px;}
    	100%{margin-top:-15px;}
    }

    #gif{width:50%;}
    #gif a img{max-width:100%; box-shadow:0 0 64px rgba(0,0,0,0.5);}


</style>
<script type="text/javascript">  
    var idleTime = 0;
    function timerIncrement() {
        idleTime = idleTime + 1;
        if (idleTime > 2) { // 20 minutes
            window.location.reload();
        }
    }
</script>
<!-- tiempo de refresco si no hay movimiento -->

</head>

<body>
<!-- Pre-loader -->
<div id="loader_div" class="loader_div"></div>
    <script>
	   window.addEventListener('load', function () {
            jQuery('.loader_div').hide();
        });
       document.firstElementChild.style.zoom ="reset";
	</script>
        <!-- End Preloader-->
<div id="signin">

	<div class="form-title">
    <img src="assets/images/logo.png" alt="" style="width: 100%;">
    </div>
	<div class="input-field">
		<input type="text" id="item" autocomplete="off" onkeypress="return event.charCode>=48 && event.charCode<=57"/>
    	<i class="mdi mdi-account-circle"></i>
		<label for="item">ITEM</label>
	</div>
	<div class="input-field">
		<input type="text" id="ci" autocomplete="off" onkeypress="return event.charCode>=48 && event.charCode<=57"/>
        <i class="mdi mdi-account-card-details"></i>
		<label for="ci">CEDULA IDENTIDAD</label>
	</div>
	<button class="login">VALIDAR</button>

	<div class="check">
        <br/>
        <div class="row">
            <div class="col-2">
                <i class="mdi mdi-backspace-outline" style="cursor: pointer" onclick="$(this).animate({fontSize : 0}, 100, function(){$('.check').addClass('out');}); window.location = './'; "></i>
            </div>
            <div class="col-10">
                <i class="mdi mdi-spin mdi-image-filter-tilt-shift"> CAT&Aacute;LOGO </i>
            </div>
        </div>
        <hr>
        <div id="nombrefuncionario" ></div>
        <div class="button-list" id="catalogo" ></div>
        <hr>
        <h4 style="color: #e30303;">Seleccione un motivo del Cat&aacute;logo</h4>
	</div>
	<div class="check2">
        <br/>
        <div class="row">
            <div class="col-2">
                <i class="mdi mdi-backspace-outline" style="cursor: pointer" onclick="$(this).animate({fontSize : 0}, 100, function(){$('.check2').addClass('out');}); window.location = './'; "></i>
            </div>
            <div class="col-10">
                <i class="mdi mdi-spin mdi-image-filter-tilt-shift"> RETORNAR </i>
            </div>
        </div>
        <hr>
        <div id="retorno" style="padding: 45px; text-align: left; padding-left: 20%"></div>
        <br>
		<button id="return" class="return">RETORNAR</button>
	</div>
</div>

</body>



</html>
<script>
$("input").on('focusout', function(){
	$(this).each(function(i, e){
		if($(e).val() != ""){
			$(e).addClass('not-empty');
		}else{
			$(e).removeClass('not-empty');
		}
	});
});

$(".login").on('click', function(){
    const item = document.getElementById('item').value;
    const ci = document.getElementById('ci').value;

    if(item == '')
    {
        jQuery
        (
        function()
            {
                Swal.fire({
                    title: 'Debe de ingresar su ITEM',
                    text: 'INCORRECTO',
                    type: 'warning'
                });
            }
        );
    }else if(ci == ''){
        jQuery
        (
        function()
            {
                Swal.fire({
                    title: 'Debe de ingresar su Cedula de Identidad',
                    text: 'INCORRECTO',
                    type: 'warning'
                });
            }
        );
    }else{
        //llamar a metodo
        $.ajax ({
                type: 'post',
                url: 'procedure/get_validaid.php',
                dataType: 'json',
                data: { 'item' : item , 'ci' : ci },
                success: function(output) {
                    //alert('ok');
                    if(output.error==0){
                    // datos correctos ok
                    //preguntar si ya salio
                    var nom = output.nombre;

                        $.ajax ({
                            type: 'post',
                            url: 'procedure/get_registro_salida.php',
                            dataType: 'json',
                            data: { 'item' : item },
                            success: function(seeregister) {

                                if(seeregister.error == -1){
                                //no salio debe de registar la salida
                                //mostrar catalogo
                                var user = 'ADMIN';
                                var entidad = 'MOTIVO_SALIDA';
                                    $.ajax ({
                                        type: 'post',
                                        url: 'procedure/get_catalogo.php',
                                        dataType: 'json',
                                        data: { 'user' : user, 'entidad' : entidad },
                                        success: function(response) {
                                                ////////
                                                // Increment the idle time counter every minute.
                                                var idleInterval = setInterval(timerIncrement, 6000); // 1 minute

                                                // Zero the idle timer on mouse movement.
                                                $(this).mousemove(function (e) {
                                                    idleTime = 0;
                                                });
                                                $(this).keypress(function (e) {
                                                    idleTime = 0;
                                                });
                                            /////////////

                                            //recorro el arreglo
                                            var len = response.catalogo.length;
                                                //insetar el nombre
                                                $("#nombrefuncionario").append('<h3 style="color: white;"><i class="mdi mdi-account-circle"></i>&nbsp;&nbsp;&nbsp;'+nom+'</h3>');
                                                //mostrar catalogo
                                                $("#catalogo").empty();
                                                for( var i = 0; i<len; i++){
                                                    var id = response.catalogo[i]['CODIGO'];
                                                    var name = response.catalogo[i]['DESCRIPCION'];
                                                    $("#catalogo").append('<button type="submit" class="btn-icon btn btn-light btn-rounded width-md waves-effect" name="submitButton" value='+id+' style="margin:10px;font-weight: bold; border: 4px solid #C4C4C4;">'+name+'</button>');
                                                }
                                                //recuperar click y enviar
                                                    $('#catalogo').on('click', '.btn-icon', function() {

                                                    jQuery('.loader_div').show();

                                                        var motivo=$(this).val();
                                                        var fecha_retorno = null;
                                                        var id_solicitud = null;
                                                        //alert(motivo);
                                                        //enviar registro salida campos null fecha_retorno, id_solicitud ,
                                                        $.ajax ({
                                                            type: 'post',
                                                            url: 'procedure/registra_salida.php',
                                                            dataType: 'json',
                                                            data: { 'item' : item, 'motivo' : motivo , 'fecha_retorno' : fecha_retorno, 'id_solicitud' : id_solicitud },
                                                            success: function(registro) {
                                                                if(registro.error == 0){
                                                                jQuery('.loader_div').hide();
                                                                // registro correctos ok
                                                                    Swal.fire({
                                                                        title: 'Se realizo el Registro',
                                                                        text: 'CORRECTO',
                                                                        type: 'success'
                                                                    }).then(function() {
                                                                        window.location = './';
                                                                    });
                                                                }else{
                                                                jQuery('.loader_div').hide();
                                                                // error al registro
                                                                    Swal.fire({
                                                                        title: 'No se logro registrar, por favor volver a intentar '+registro.detalle,
                                                                        text: 'INCORRECTO',
                                                                        type: 'warning'
                                                                    }).then(function() {
                                                                        window.location = './';
                                                                    });
                                                                }
                                                            }
                                                        });
                                                    });

                                            $(this).animate({
                                    		fontSize : 0
                                        	}, 300, function(){
                                        		$(".check").addClass('in');
                                        	});
                                        }
                                    });

                                }else{
                                //si salio debe de registrar el retorno
                                    var len = seeregister.datos.length;
                                    ////////
                                        // Increment the idle time counter every minute.
                                        var idleInterval = setInterval(timerIncrement, 6000); // 1 minute

                                        // Zero the idle timer on mouse movement.
                                        $(this).mousemove(function (e) {
                                            idleTime = 0;
                                        });
                                        $(this).keypress(function (e) {
                                            idleTime = 0;
                                        });
                                    /////////////
                                    $("#retorno").empty();

                                        var id_solicitud = seeregister.datos[0]['ID_SOLICITUD'];
                                        var itemreg = seeregister.datos[0]['NRO_ITEM'];
                                        var motivo = seeregister.datos[0]['COD_MOTIVO'];
                                        var fecha_salida = seeregister.datos[0]['FECHA_SALIDA'];
                                        $("#retorno").append('<h3 style="color: white;"><i class="mdi mdi-account-circle"></i>&nbsp;&nbsp;&nbsp;ITEM: '+itemreg+'</h3>');
                                        $("#retorno").append('<h3 style="color: white;"><i class="mdi mdi mdi-import"></i>&nbsp;&nbsp;&nbsp;MOTIVO: '+motivo+'</h3>');
                                        $("#retorno").append('<h3 style="color: white;"><i class="mdi mdi-clock-outline"></i>&nbsp;&nbsp;&nbsp;SALIDA: '+fecha_salida+'</h3>');

                                    $(this).animate({
                                		fontSize : 0
                                    	}, 300, function(){
                                    		$(".check").addClass('out');
                                    		$(".check2").addClass('in');
                                    	});

                                        //recuperar click y enviar
                                        $('#return').on('click', function() {

                                        jQuery('.loader_div').show();
                                            //enviar retorno
                                            $.ajax ({
                                                type: 'post',
                                                url: 'procedure/registra_salida.php',
                                                dataType: 'json',
                                                data: { 'item' : item, 'motivo' : motivo , 'fecha_salida' : fecha_salida, 'id_solicitud' : id_solicitud },
                                                success: function(retorno) {
                                                    if(retorno.error == 0){
                                                    jQuery('.loader_div').hide();
                                                    // registro de retorno correctos ok
                                                        Swal.fire({
                                                            title: 'Se registro el Retorno',
                                                            text: 'CORRECTO',
                                                            type: 'success'
                                                        }).then(function() {
                                                            window.location = './';
                                                        });
                                                    }else{
                                                    jQuery('.loader_div').hide();
                                                    // error al registrar el retorno
                                                        Swal.fire({
                                                            title: 'No se logro registrar, por favor volver a intentar',
                                                            text: 'INCORRECTO',
                                                            type: 'warning'
                                                        }).then(function() {
                                                            window.location = './';
                                                        });
                                                    }
                                                }
                                            });

                                        });
                                }
                            }
                        });
                    }else{
                    // datos incorrectos inotok
                        Swal.fire({
                            title: output.detalle,
                            text: 'INCORRECTO',
                            type: 'warning'
                        }).then(function() {
                            window.location = './';
                        });
                    };
                }
            });
    }
});


</script>