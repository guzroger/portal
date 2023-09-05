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
					<?php echo $form->textField($model,'code_module', array('maxlength'=>"50",'class'=>'form-control')); ?>
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
					<select class="form-control" name="submodel" required>
                        <option value="">SELECCIONAR</option>
                        <?php foreach($modules['modules'] as $module){ ?>
                        <optgroup label="<?php echo $module['name']; ?>">
                        	<?php foreach($module['submodules'] as $submodule){ ?>
	                            <option value="<?php echo $submodule['id']; ?>"><?php echo $submodule['name']; ?></option>
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
                        	<?php foreach($personals['employees'] as $employees){ ?>
	                            <option value="<?php echo $employees['name']; ?>"><?php echo $employees['name']; ?></option>
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
					<label>Archivo</label>
					<input name="onefile" id="onefile" type="file" />  
					<br>  
				</div>

				<div class="col-md-4">
					<?php echo $form->labelEx($model,'files'); ?>
					<?php echo $form->checkBox($model,'files', array('id'=>'sendMany','onClick'=>'manyFiles();')); ?><br>
                    <button id="btnMany" style="display:none;" type="button" class="btn btn-icon btn-block waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#modalFiles"> 
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
				<div class="col-md-12">
	            <hr>
	                <?php echo CHtml::submitButton('Guardar', array('class'=>'btn btn-block btn-info')); ?>
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

$('#postTitle').on('keyup',function(){
    var input = $(this);
    input.next("span").text(input.val().length + " /150 Caractares");
});

$('#postDescription').on('keyup',function(){
    var input = $(this);
    input.next("span").text(input.val().length + " /250 Caractares");
});
</script>