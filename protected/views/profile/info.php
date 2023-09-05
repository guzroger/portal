<?php 
if($model['photoUp'] == null){
    $photo = $model['photo'];
}else{
    $photo = $model['photoUp'];
}

?>

<div class="thumb-xl member-thumb m-b-10 center-block">
    <img src="<?php echo Yii::app()->createUrl('api/showPersonal',array('filename'=>$photo)); ?>" class="rounded-circle img-thumbnail" width="200" alt="profile-image">
</div>

<div class="">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalImage"><i class="fa fa-image"></i> Cambiar Foto</button>
    <br>
    <?php 
    if(isset($_GET['phE'])){
        $error = $_GET['phE'];
        if($error == '-100'){
            echo '<small class="text-danger"><b>Intentelo Nuevamente.</b></small>';
        }elseif($error == '100'){
            echo '<small class="text-success"><b>Cambio Exitoso!</b></small>';
        }elseif($error == '-101'){
            echo '<small class="text-danger"><b>Archivo Vacios.</b></small>';
        }
    }
    ?>
    <br>
    <h5 class="m-b-5"><?php echo $model['name']; ?></h5>
    <p class="text-muted"><?php echo $model['item']; ?></p>
</div>

<hr>

<div class="text-left m-t-20">
    <p class="text-muted font-13"><strong>Area:</strong> <span class="m-l-10"><?php echo $model['area']; ?></span></p>

    <p class="text-muted font-13"><strong>Cargo:</strong><span class="m-l-10"><?php echo $model['charge']; ?></span></p>

    <p class="text-muted font-13"><strong>Email:</strong> <span class="m-l-10"><?php echo $model['email']; ?></span></p>

    <p class="text-muted font-13"><strong>Directo:</strong> <span class="m-l-10"><?php echo $model['phone_direct']; ?></span></p>

    <p class="text-muted font-13"><strong>Corporativo:</strong> <span class="m-l-10"><?php echo $model['phone_corp']; ?></span></p>

    <p class="text-muted font-13"><strong>Interno:</strong> <span class="m-l-10"><?php echo $model['phone_int']; ?></span></p>

    <p class="text-muted font-13"><strong>Edificio:</strong> <span class="m-l-10"><?php echo $model['building']; ?> <?php echo $model['building_flat']; ?></span></p>
</div>
<?php if(!empty($model['groups'])){ ?>
<hr>
<div class="text-left m-t-20">
    <h4>Mis Grupos</h4>
    <?php foreach($model['groups'] as $grupos){ ?>
        <div class="card-box widget-user">
            <div>
                <img src="<?php echo Yii::app()->createUrl('api/showGroups',array('filename'=>$grupos['photo'])); ?>" class="rounded-circle" alt="user" data-toggle="tooltip" data-placement="right" title="<?php echo $grupos['name']; ?>">
                <div class="wid-u-info">
                    <h5 class="mt-0 m-b-5 font-16"><?php echo $grupos['name']; ?></h5>
                    <p class="text-muted m-b-5 font-13">Cantidad de Miembros: <?php echo $grupos['quantity']; ?></p>
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('groups/index',array('cddGr'=>$grupos['code'])); ?>" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5">Visitar</a>
                </div>
            </div>
        </div>
    <?php } ?>

</div>
<?php } ?>
<div id="modalImage" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalImageLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="full-width-modalLabel">Subir Imagenes</h4>
            </div>
            <form method="POST" action="<?php echo Yii::app()->createUrl('profile/photo'); ?>" enctype="multipart/form-data" onsubmit="jQuery('.loader_div').show();$('#modalImage').modal('hide');">
                <div class="modal-body">
                    <div class="col-md-12" align="center">
                        <i class="fa fa-image fa-5x"></i>
                        <hr>
                    </div>
                    <input name="photoUp" id="photoUp" type="file" accept="image/x-png,image/gif,image/jpeg" />
                    <br><br>
                    <span>Foto Tamaño M&aacute;ximo 400px por 400px</span>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="photoUpload" class="btn btn-primary waves-effect waves-light">Guardar</button>
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->