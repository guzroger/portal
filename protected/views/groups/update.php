<div class="row">
    <div class="col-lg-12">
        <div class="">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <?php $this->renderPartial('menu',array('manager'=>$manager,'member'=>$member)); ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'group-c-form',
                                // Please note: When you enable ajax validation, make sure the corresponding
                                // controller action is handling ajax validation correctly.
                                // See class documentation of CActiveForm for details on this,
                                // you need to use the performAjaxValidation()-method described there.
                                'enableAjaxValidation'=>false,
                                'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                            )); ?>
                                <div class="row">

                                    <?php echo $form->errorSummary($model); ?>


                                    <div class="col-md-12">
                                        <?php echo $form->labelEx($model,'name'); ?>
                                        <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
                                        <?php echo $form->error($model,'name'); ?>
                                    </div>

                                    <div class="col-md-12">
                                        <?php echo $form->labelEx($model,'description'); ?>
                                        <?php echo $form->textField($model,'description', array('class'=>'form-control')); ?>
                                        <?php echo $form->error($model,'description'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model,'photo'); ?><br>
                                        <?php echo $form->fileField($model,'photo'); ?>
                                        <?php echo $form->error($model,'photo'); ?><br>
                                        <small>Fotografia de 400px * 400px</small>
                                    </div>

                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model,'public_phone'); ?>
                                        <?php echo $form->textField($model,'public_phone', array('class'=>'form-control')); ?>
                                        <?php echo $form->error($model,'public_phone'); ?>
                                    </div>

                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model,'mail'); ?>
                                        <?php echo $form->textField($model,'mail', array('class'=>'form-control')); ?>
                                        <?php echo $form->error($model,'mail'); ?>
                                    </div>

                                    <div class="col-md-6">
                                        <?php echo $form->labelEx($model,'public_mail'); ?>
                                        <?php echo $form->textField($model,'public_mail', array('class'=>'form-control')); ?>
                                        <?php echo $form->error($model,'public_mail'); ?>
                                    </div>


                                    <div class="col-md-12">
                                    <hr>
                                        <?php echo CHtml::submitButton('Guardar', array('class'=>'btn btn-block btn-info')); ?>
                                    </div>
                                </div>

                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end col -->
</div>