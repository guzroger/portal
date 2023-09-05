<?php if(!empty($model['personal'])){ ?>
	<div class="col-md-12 form-group row">
        <div class="col-md-6 col-xs-12">
        	<label>Buscar Funcionario</label>
            <input type="text" class="form-control" placeholder="Introduzca el Nombre, Item &oacute; Area" id="searchBox" onkeyup="directoryFind('<?php echo count($model['personal']) + 1;?>')">
        </div>
        <div class="col-md-6 col-xs-12">
        	<label>Permisos</label>
        	<div class="row">
		        <div class="col-md-4 col-sm-12 col-xs-12">
		            <div class="custom-control custom-radio">
                        <input type="radio" id="allCheck" name="checkLicense" onclick="selectLicense('allCheck');" class="custom-control-input" checked="">
                        <label class="custom-control-label" for="allCheck">Todos</label>
                    </div>     
		        </div>
		        <div class="col-md-4 col-sm-12 col-xs-12">
		            <div class="custom-control custom-radio">
                        <input type="radio" id="sinCheck" name="checkLicense" onclick="selectLicense('sinCheck');" class="custom-control-input">
                        <label class="custom-control-label" for="sinCheck">Sin Permiso</label>
                    </div>
		        </div>
		        <div class="col-md-4 col-sm-12 col-xs-12">
		            <div class="custom-control custom-radio">
                        <input type="radio" id="conCheck" name="checkLicense" onclick="selectLicense('conCheck');" class="custom-control-input">
                        <label class="custom-control-label" for="conCheck">Con Permiso</label>
                    </div>
		        </div>       		
        	</div>
    	</div>
    </div>
<?php } ?>

<div class="row">
    <div class="col-12">
        <div class="text-center portfolioFilter">
            <a href="javascript:void(0);" id="all" onclick="selectPersonal('all');" class="current">Todos</a>
            <a href="javascript:void(0);" id="connected" onclick="selectPersonal('connected')">Conectados</a>
            <a href="javascript:void(0);" id="disconnected" onclick="selectPersonal('disconnected')">Desconectados</a>
            <?php /*
            <a href="javascript:void(0);" id="noactive" onclick="selectPersonal('noactive')">No Disponibles</a>
            <a href=javascript:void(0);" id="inactive" onclick="selectPersonal('inactive')">Inactivos</a>
            */ ?>
        </div>
        <hr>
    </div>
</div>
<div class="port m-b-20">
    <div id="wrapper">
        <div class="row scrollbar"  id="style-2">
	        <?php $cantidad = 1; ?>
	        <?php foreach($model['personal'] as $personal){ ?>
	            <?php 
	            if($personal['photoUp'] == null){
	                $photo = $personal['photo'];
	            }else{
	                $photo = $personal['photoUp'];
	            }
	            if($personal['statusNum'] == 1){
	            	$filter = 'connected';
	            	$color = 'text-success';
	            }elseif($personal['statusNum'] == 2){
	            	$filter = 'disconnected';
	            	$color = 'text-danger';
	            }elseif($personal['statusNum'] == 3){
	            	$filter = 'noactive';
	            	$color = 'text-warning';
	            }elseif($personal['statusNum'] == 0){
	            	$filter = 'inactive';
	            	$color = 'text-secondary';
	            }

	            if($personal['license'] == 'SIN PERMISO'){
	            	$filterLic = 'licenseNo';
	            }elseif($personal['license'] == 'CON PERMISO'){
	            	$filterLic = 'licenseYes';
	            }else{
	            	$filterLic = 'licenseNo';
	            }

	            ?>
	                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 <?php echo $filter;?> <?php echo $filterLic;?>" id="personal<?php echo $cantidad;?>">
	                    <div class="card-box widget-user">
	                        <div>
	                            <img src="<?php echo Yii::app()->createUrl('api/showPersonal',array('filename'=>$photo)); ?>" class="rounded-circle" alt="user" data-toggle="tooltip" data-placement="right" title="<?php echo $personal['name'];?>">
	                            <div class="wid-u-info">
	                                <h5 class="mt-0 m-b-5 font-16"><?php echo $personal['name'];?></h5>
	                                <p class="text-muted m-b-5 font-13">ITEM: <?php echo $personal['item'];?></p>
	                                <p class="text-muted m-b-5 font-10">AREA: <?php echo $personal['area'];?></p>
	                                <p class="text-muted m-b-5 font-10">PERMISO: <?php echo $personal['license'];?></p>
	                                <small class="<?php echo $color; ?>"><b><?php echo $personal['status'];?></b></small><br>
	                                <button type="button" class="btn btn-danger btn-custom m-b-5" data-toggle="modal" data-target="#<?php echo $personal['item'];?>">
	                                    Informaci&oacute;n
	                                </button>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="modal fade" id="<?php echo $personal['item'];?>" tabindex="-1" role="dialog" aria-labelledby="profileModal" style="display: none;" aria-hidden="true">
	                        <div class="modal-dialog modal-lg">
	                            <div class="modal-content">
	                                <div class="modal-header">
	                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                                    <h4 class="modal-title" id="profileModal"><i class="fa fa-user"></i> Informaci&oacute;n</h4>
	                                </div>
	                                <div class="modal-body">
	                                    <div class="text-center card-box">
	                                        <div class="member-card">
	                                            <div class="member-thumb m-b-10 center-page">
	                                                <img src="<?php echo Yii::app()->createUrl('api/showPersonal',array('filename'=>$photo)); ?>" class="rounded-circle" alt="profile-image" height="180px">
	                                            </div>

	                                            <div class="">
	                                                <h4 class="m-b-5 mt-2"><?php echo $personal['name'];?></h4>
	                                                <p class="text-muted">ITEM: <?php echo $personal['item'];?></p>
	                                            </div>

	                                            <div class="text-left m-t-40 row">
	                                                <p class="text-muted font-16 col-lg-12"><strong>Area :</strong> <span class="m-l-15"><?php echo $personal['area'];?></span></p>

	                                                <p class="text-muted font-16 col-lg-12"><strong>Cargo :</strong><span class="m-l-15"><?php echo $personal['charge'];?></span></p>

	                                                <p class="text-muted font-16 col-lg-12"><strong>Email :</strong> <span class="m-l-15"><?php echo $personal['email'];?></span></p>

	                                                <p class="text-muted font-16 col-lg-4"><strong>Corporativo :</strong> <span class="m-l-15"><?php echo $personal['phone_corp'];?></span></p>

	                                                <p class="text-muted font-16 col-lg-4"><strong>Directo :</strong> <span class="m-l-15"><?php echo $personal['phone_direct'];?></span></p>

	                                                <p class="text-muted font-16 col-lg-4"><strong>Interno :</strong> <span class="m-l-15"><?php echo $personal['phone_int'];?></span></p>

	                                                <p class="text-muted font-16 col-lg-12"><strong>Edificio :</strong> <span class="m-l-15"><?php echo $personal['building'];?> <?php echo $personal['building_flat'];?></span></p>

                                                	<p class="text-muted font-16 col-lg-12"><strong>Permiso :</strong> <span class="m-l-15"><?php echo $personal['license'];?></span></p>
	                                                <?php if(!empty($personal['schedules'])){ ?>
	                                                	<?php foreach($personal['schedules'] as $schedules){ ?>
	                                                		<p class="text-muted font-16 col-lg-12"><strong>Horario Turno "<?php echo $schedules['turn'];?>":</strong></p>
	                                                		<p class="text-muted font-16 col-lg-6"><strong>Ingreso :</strong> <span class="m-l-15"><?php echo $schedules['entry'];?></span></p>
	                                                		<p class="text-muted font-16 col-lg-6"><strong>Salida :</strong> <span class="m-l-15"><?php echo $schedules['output'];?></span></p>
	                                                	<?php } ?>
	                                                <?php }else{ ?>
	                                                	<p class="text-muted font-16 col-lg-4"><strong>Horario :</strong> <span class="m-l-15">NO DISPONIBLE</span></p>
	                                                <?php } ?>
	                                            </div>                                        
	                                        </div>
	                                    </div> <!-- end card-box -->
	                                </div>
	                            </div><!-- /.modal-content -->
	                        </div><!-- /.modal-dialog -->
	                    </div>
	                    <input type="hidden" id="searchName<?php echo $cantidad;?>" value="<?php echo $personal['name'];?>">
	                    <input type="hidden" id="searchItem<?php echo $cantidad;?>" value="<?php echo $personal['item'];?>">
	                    <input type="hidden" id="searchArea<?php echo $cantidad;?>" value="<?php echo $personal['area'];?>">
	                </div>
	                <?php $cantidad = $cantidad + 1; ?>
	        <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
setTimeout(function(){
	jQuery('.loader_div').hide();
}, 3000);    
</script>