<div class="row">
    <div class="col-md-12">
        <div class="card-box">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'module-data-c-form',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
                'htmlOptions'=>array('enctype'=>'multipart/form-data','onsubmit'=>"jQuery('.loader_div').show();"),
			)); ?>
        	<div class="row">

				<?php echo $form->errorSummary($model); ?>
				<div class="col-md-4">
					<?php echo $form->labelEx($model,'code_module'); ?>
					<?php echo $form->textField($model,'code_module', array('maxlength'=>"11",'class'=>'form-control')); ?>
					<span class="help-block"><small></small></span>
					<?php echo $form->error($model,'code_module'); ?>
					<br>
				</div>
				<div class="col-md-4">
					<?php echo $form->labelEx($model,'date_approved'); ?>
					<?php echo $form->textField($model,'date_approved', array('maxlength'=>"11",'class'=>'form-control', 'id'=>"datepicker-autoclose-ini",'readonly'=>'readonly','value'=>date('d/m/Y'))); ?>
					<span class="help-block"><small></small></span>
					<?php echo $form->error($model,'date_approved'); ?>
					<br>
				</div>
				<div class="col-md-4">
					<?php echo $form->labelEx($model,'version'); ?>
					<?php echo $form->textField($model,'version', array('maxlength'=>"11",'class'=>'form-control')); ?>
					<span class="help-block"><small></small></span>
					<?php echo $form->error($model,'version'); ?>
					<br>
				</div>
				<div class="col-md-6">
					<label>Categoria</label>
					<select class="form-control select2" name="submodel" required>
                        <option value="">SELECCIONAR</option>
                        <?php foreach($modules['modules'] as $module){ ?>
                        <optgroup label="<?php echo $module['name']; ?>">
                        	<?php foreach($module['submodules'] as $submodule){ 
                        		if($submodule['id'] == $model->module_sub_id){
                        			$selected = 'selected';
                        		}else{
                        			$selected = '';
                        		}
                        		?>
	                            <option value="<?php echo $submodule['id']; ?>" <?php echo $selected; ?> ><?php echo $submodule['name']; ?></option>
	                        <?php } ?>
                        </optgroup>
                        <?php } ?>
                    </select>
					<br>
                </div>

				<div class="col-md-6">
					<?php echo $form->labelEx($model,'title'); ?>
					<?php echo $form->textField($model,'title', array( 'maxlength'=>"150",'class'=>'form-control','required'=>'required','id'=>'postTitle')); ?>
					<span class="help-block"><small></small></span>
					<?php echo $form->error($model,'title'); ?>
					<br>
				</div>

				<div class="col-md-12">
					<label>Aprobado Por</label>
					<select class="form-control select2" name="personal" required>
                        <option value="">SELECCIONAR</option>
                        <?php foreach($modules['personals'] as $personals){ ?>
                        <optgroup label="<?php echo $personals['area']; ?>">
                        	<?php foreach($personals['employees'] as $employees){ 
                        		if($employees['name'] == $model->approved){
                        			$selected2 = 'selected';
                        		}else{
                        			$selected2 = '';
                        		}
                        		?>
	                            <option value="<?php echo $employees['name']; ?>"<?php echo $selected2; ?> ><?php echo $employees['name']; ?></option>
	                        <?php } ?>
                        </optgroup>
                        <?php } ?>
                    </select>
					<br>
                </div>

				<div class="col-md-12">
					<?php echo $form->labelEx($model,'description'); ?>
					<?php echo $form->textField($model,'description', array('maxlength'=>"250",'class'=>'form-control','id'=>'postDescription')); ?>
					<span class="help-block"><small></small></span>
					<?php echo $form->error($model,'description'); ?>
					<br>
				</div>

				<div class="col-md-12">
					<?php echo $form->labelEx($model,'information'); ?>
					<?php echo $form->textArea($model,'information', array('class'=>'form-control','id'=>'info')); ?>
					<?php echo $form->error($model,'information'); ?>
					<br>
				</div>

				<div class="col-md-4">
					<?php if($model->file != null){ ?>
						<label>Archivo:</label><br>
						<a href="<?php echo Yii::app()->createUrl('api/showModulesFiles',array('filename'=>$model->file,'code'=>$_GET['modC'])); ?>" class="btn btn-icon waves-effect waves-light btn-dark m-b-5" data-toggle="tooltip" data-placement="bottom" title="Descargar Archivo"><i class="fa fa-cloud-download"></i> Descargar</a>
						<a onclick="$('#modalDeleteOne').modal('show');"  class="btn btn-icon waves-effect waves-light btn-danger text-light m-b-5" data-toggle="tooltip" data-placement="bottom" title="Eliminar Archivo"><i class="fa fa-trash"></i> Eliminar</a><br>
						<!--MODALS -->
                        <div id="modalDeleteOne" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDeleteOneLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="full-width-modalLabel">Eliminar Archivo</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <h2>ESTA SEGURO DE ELIMINAR ESTE ARCHIVO?</h2>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="deleteFileOne('<?php echo $model->id; ?>','<?php echo $_GET['modC']; ?>','<?php echo $_GET['modI']; ?>');" >SI</button>
                                        <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">NO</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog  modal-lg -->
                        </div><!-- /.modal -->	
					<?php } ?>
					<label>Subir Archivo:</label><br>
					<input name="onefile" id="onefile" type="file" />  
					<br>  
				</div>

				<div class="col-md-4">
					<?php echo $form->labelEx($model,'files'); ?>
					<?php echo $form->checkBox($model,'files', array('id'=>'sendMany','onClick'=>'manyFiles();')); ?><br>
					<?php 
					if($model->files == 1){ 
						$estilo = 'display:block;';
					}else{
						$estilo = 'display:none;';
					}
						
					?>					
                    <button id="btnMany" style="<?php echo $estilo; ?>" type="button" class="btn btn-icon btn-block waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#modalFiles"> 
                        <i class="fa fa-file-zip-o"></i> Archivos
                    </button>  
					<?php echo $form->error($model,'files'); ?>
					<br>
				</div>

				<div class="col-md-4">
					<?php echo $form->labelEx($model,'status'); ?>
					<?php echo $form->dropDownList($model,'status', array(
	                '1'=>'Activo',
	                '0'=>'Inactivo'
	                ),array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'status'); ?>
					<br>
				</div>
				<?php if($model->files == 1){ ?>
					<?php  
					$criteria = new CDbCriteria(); 

					$criteria->addCondition('module_data_id='.$model->id);

					$criteria->addCondition('status != 3');

					$archivos = ModuleDataFiles::model()->findAll($criteria);
					?>
					<?php if(!empty($archivos)){ ?>
						<div class="col-md-12">
							<h4>Archivos Cargados</h4>
							<div class="table-responsive">
		                        <table class="table table-striped table-bordered">
		                            <thead>
		                                <tr>
		                                    <th>Fecha Registro</th>
		                                    <th>Nombre</th>
		                                    <th>Estado</th>
		                                    <th>Acciones</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                            	<?php foreach($archivos as $archivo){ ?>
			                            <tr>
			                            	<td><?php echo date('d/m/Y',strtotime($archivo->date_register)); ?></td>
			                            	<td><?php echo urldecode($archivo->name); ?></td>
			                            	<td>
			                            	<?php 
				                            	if($archivo->status == 1){
				                            		$estado = 'ACTIVO';
				                            	}elseif($archivo->status == 0){
				                            		$estado = 'INACTIVO';
				                            	}else{
				                            		$estado = 'NN';
				                            	}
				                            	echo $estado;
			                            	?>
			                            	</td>
			                            	<td align="center">
			                            		<a href="<?php echo Yii::app()->createUrl('api/showModulesFiles',array('filename'=>$archivo['file'],'code'=>$_GET['modC'])); ?>" class="btn btn-icon waves-effect waves-light btn-dark m-b-5" data-toggle="tooltip" data-placement="bottom" title="Descargar Archivo"><i class="fa fa-cloud-download"></i></a>
			                            		<?php if($archivo->status == 1){ ?>
			                            			<a class="btn btn-icon waves-effect waves-light btn-secondary m-b-5 text-light" onclick="executeFiles('<?php echo $archivo['id']; ?>', 'fhcErx','<?php echo $_GET['modC']; ?>','<?php echo $_GET['modI']; ?>');" data-toggle="tooltip" data-placement="bottom" title="Inactivar"><i class="fa fa-toggle-off"></i></a>
			                            		<?php } ?>
			                            		<?php if($archivo->status == 0){ ?>
			                            			<a class="btn btn-icon waves-effect waves-light btn-success m-b-5 text-light" onclick="executeFiles('<?php echo $archivo['id']; ?>', 'SyhoKo','<?php echo $_GET['modC']; ?>','<?php echo $_GET['modI']; ?>');" data-toggle="tooltip" data-placement="bottom" title="Activar"><i class="fa fa-toggle-on"></i></a>
			                            		<?php } ?>
			                            		<a class="btn btn-icon waves-effect waves-light btn-danger m-b-5 text-light" onclick="$('#modalDelete<?php echo $archivo['id']; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-trash"></i></a>
			                            	</td>	
			                            	<!--MODALS -->
                                            <div id="modalDelete<?php echo $archivo['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog  modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="full-width-modalLabel">Eliminar Archivo</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <h2>ESTA SEGURO DE ELIMINAR ESTE ARCHIVO?</h2>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="deleteFiles('<?php echo $archivo['id']; ?>','<?php echo $_GET['modC']; ?>','<?php echo $_GET['modI']; ?>');" >SI</button>
                                                            <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">NO</button>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog  modal-lg -->
                                            </div><!-- /.modal -->	                            	
			                            </tr>
			                            <?php } ?>
		                            </tbody>
		                        </table>
		                    </div>
						</div>
					<?php } ?>
				<?php } ?>
				<div class="col-md-12">
	            <hr>
	            </div>
				<div class="col-md-6">	            
	                <?php echo CHtml::submitButton('Guardar', array('class'=>'btn btn-block btn-info')); ?>
	            </div>
				<div class="col-md-6">
					<a href="<?php echo Yii::app()->createUrl('modules/index',array('modC'=>$_GET['modC'])); ?>" class="btn btn-danger btn-block" >Volver</a>
	            </div>
				<div id="modalFiles" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalFilesLabel" aria-hidden="true" style="display: none;">
                    <?php $this->renderPartial('modal'); ?>
                </div><!-- /.modal -->
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div><!-- form -->
<script type="text/javascript">

CKEDITOR.replace("info",{
    uiColor:'#f3f3f3',
    language:'es',
    toolbar :[['Styles', 'Format'],['Bold', 'Italic', 'Underline', '-', 'NumberedList',
    'BulletedList', '-', 'Link'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['Image','Youtube']]
});

function manyFiles()
{
  	if (document.getElementById('sendMany').checked) 
  	{
      	document.getElementById("btnMany").style.display = "block";
  	} else {
       	document.getElementById("btnMany").style.display = "none";
  	}
}

function executeFiles(value1, value2, value3, value4)
{
  	$.ajax({
      	type: 'POST',
      	url: "<?php echo Yii::app()->createUrl('modules/updateStatus'); ?>",
      	dataType: "json",          
      	data: {
      	    'codId' : value1,
      	    'codAcc' : value2,
      	    'codGl' : value3,
      	    'codMod' : value4,
      	},
      	success: function (output) {
      	  	if(output.error == 0){
	            jQuery(".loader_div").hide();
	            window.location.href = "index.php?r=site/index";
	        }else if(output.error == 1){
	            jQuery(".loader_div").hide();
	            window.location.href = "index.php?r=modules/update&modC="+output.token+"&modI="+output.param;
	        }
      	}
    });
}

function deleteFiles(value1, value2, value3)
{
  	$.ajax({
      	type: 'POST',
      	url: "<?php echo Yii::app()->createUrl('modules/deleteFiles'); ?>",
      	dataType: "json",          
      	data: {
      	    'codId' : value1,
      	    'codGl' : value2,
      	    'codMod' : value3,
      	},
      	success: function (output) {
      	  	if(output.error == 0){
	            jQuery(".loader_div").hide();
	            window.location.href = "index.php?r=site/index";
	        }else if(output.error == 1){
	            jQuery(".loader_div").hide();
	            window.location.href = "index.php?r=modules/update&modC="+output.token+"&modI="+output.param;
	        }
      	}
    });
}

function deleteFileOne(value1, value2, value3)
{
  	$.ajax({
      	type: 'POST',
      	url: "<?php echo Yii::app()->createUrl('modules/deleteFileOne'); ?>",
      	dataType: "json",          
      	data: {
      	    'codId' : value1,
      	    'codGl' : value2,
      	    'codMod' : value3,
      	},
      	success: function (output) {
      	  	if(output.error == 0){
	            jQuery(".loader_div").hide();
	            window.location.href = "index.php?r=site/index";
	        }else if(output.error == 1){
	            jQuery(".loader_div").hide();
	            window.location.href = "index.php?r=modules/update&modC="+output.token+"&modI="+output.param;
	        }
      	}
    });
}


$('#postTitle').on('keyup',function(){
    var input = $(this);
    input.next("span").text(input.val().length + " /150 Caractares");
});

$('#postDescription').on('keyup',function(){
    var input = $(this);
    input.next("span").text(input.val().length + " /250 Caractares");
});
</script>