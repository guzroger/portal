<?php
$validar = ApiData::BasicInfo();
?>
<div class="row">
    <div class="col-xl-3 col-xs-12  order-2">
        <div class="text-center card-box">
            <div class="member-card">
                <?php $this->renderPartial('info',array('model'=>$model)); ?>
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
    <div class="col-xl-9 col-xs-12  order-1 order-xl-9">
        <div class="">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <?php $this->renderPartial('menu'); ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="row">  
                            <div class="col-md-12">
                                <h4>Cambiar Contrase&ntilde;a</h4>
                            </div> 
                            <?php if($validar['password'] == 'comteco2020.'){ ?>
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <strong>Informe: </strong> Usted tiene una contrase&ntilde;a gen&eacute;rica, por favor cambie su contraseña para mayor seguridad.
                                </div>                                    
                            </div>
                            <?php } ?>
                            <div class="col-md-12">
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Contrase&ntilde;a Actual</label>
                                            <input type="text" class="form-control" id="oldPass" name="oldPass" value="<?php echo $validar['password']; ?>" required readonly="readonly">
                                            <br>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Nueva Contrase&ntilde;a</label>
                                            <input type="text" class="form-control" id="newPass" name="newPass" value="" required>
                                            <div id="strength_message"></div>                                            
                                        </div>
                                        <div class="col-md-6">
                                            <label>Repetir Contrase&ntilde;a</label>
                                            <input type="password" class="form-control" id="repPass" name="repPass" value="" required readonly="readonly">
                                            <span id='message'></span>
                                        </div> 
                                        <div class="col-md-12">
                                            <br>
                                            <div class="alert alert-info text-dark">
                                                <i class="fa fa-info-circle"></i> Nota: Su nueva contrase&ntilde;a debe tener minimo 6 caracteres y una minimo una letra mayuscula.
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                            <button type="submit" id="register" name="register" class="btn btn-danger btn-rounded btn-block w-md waves-effect waves-light m-b-5" disabled>Cambiar Contrase&ntilde;a</button>
                                            <br><br>
                                            <span class="text-danger"><b>Advertencia: Al cambiar su contrase&ntilde;a se cerrar&aacute; automaticamente su sesi&oacute;n.</b></span>
                                        </div>                                       
                                    </div>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#newPass, #repPass').on('keyup', function () {
      if ($('#newPass').val() == $('#repPass').val()) {
        $('#message').html('Contraseña Iguales').css('color', 'green');

        document.getElementById("register").disabled = false;
      } else {
        $('#message').html('Contraseña Diferente').css('color', 'red');

        document.getElementById("register").disabled = true;
    }
    });
    $('#newPass').keyup(function()
    {
        $('#strength_message').html(checkStrength($('#newPass').val()));
        if ($('#strength_message').hasClass('short')) { 
            document.getElementById("repPass").readOnly = true;
        }
        else if ($('#strength_message').hasClass('weak')){
            document.getElementById("repPass").readOnly = true;
        }
        else if ($('#strength_message').hasClass('good')) {
            document.getElementById("repPass").readOnly = false;
        }
        else if ($('#strength_message').hasClass('strong')) {
            document.getElementById("repPass").readOnly = false;
        }
    }) 
    function checkStrength(password)
    {
        var strength = 0
        if (password.length < 6) { 
            $('#strength_message').removeClass()
            $('#strength_message').addClass('short')
            return "<div class='col-xs-12'><p style='color:#B40404;'><i class='fa fa-warning'></i> Contraseña muy Corta</p></div> "
        }
        
        if (password.length > 7) strength += 1
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        if (strength < 2 )
        {
            $('#strength_message').removeClass()
            $('#strength_message').addClass('weak')
            return "<div class='col-xs-12'><p style='color:#F70000;'><i class='fa fa-thumbs-o-down'></i> Contraseña Debil</p></div> "                               
        }
        else if (strength == 2 )
        {
            $('#strength_message').removeClass()
            $('#strength_message').addClass('good')
            return "<div class='col-xs-12'><p style='color:orange;'><i class='fa fa-thumbs-o-up'></i> Contraseña Buena</p></div> "       
        }
        else
        {
            $('#strength_message').removeClass()
            $('#strength_message').addClass('strong')
            return "<div class='col-xs-12'><p style='color:green;'><i class='fa fa-check-circle'></i> Contraseña Excelente</p></div> "
        }
    } 
</script>