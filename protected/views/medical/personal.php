<?php if(!empty($model)){ ?>
<div class="port m-b-20">
    <div id="wrapper">
        <div class="row scrollbar"  id="style-2">
	        <?php foreach($model as $value){ ?>
	        	<?php 
				if($value->code != 0){
					$foto = $value->code.'.jpg';
				}else{
					$foto = 'user.png';
				}
				?>
	        	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
	                <div class="card-box widget-user">
	                    <div>
	                        <img src="<?php echo Yii::app()->createUrl('api/showPersonal',array('filename'=>$foto)); ?>" class="rounded-circle" alt="user" data-toggle="tooltip" data-placement="right" title="<?php echo $value->name;?>">
	                        <div class="wid-u-info">
	                            <h5 class="mt-0 m-b-5 font-16"><?php echo $value->name;?></h5>
	                            <p class="text-muted m-b-5 font-13">Celular: <?php echo $value->cellphone;?></p>
	                            <p class="text-muted m-b-5 font-13">Tel&eacute;fonos: <?php echo $value->phone;?></p>
	                            <p class="text-muted m-b-5 font-13">Email: <?php echo $value->email;?></p>
	                            <a href="<?php echo $this->createUrl('calendar',array('med'=>$value->id)); ?>" class="btn btn-danger btn-custom m-b-5">
	                                Registrar Consulta
	                            </a>
	                        </div>
	                    </div>
	                </div>
	            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>