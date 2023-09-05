<div class="row">
    <div class="col-lg-12">
        <div class="">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <?php $this->renderPartial('menu'); ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'company-c-form',
                            'enableAjaxValidation'=>false,
                        )); ?>
                            <div class="row">

                                <?php echo $form->errorSummary($model); ?>

                                <div class="col-md-12">
                                    <?php echo $form->labelEx($model,'name'); ?>
                                    <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
                                    <?php echo $form->error($model,'name'); ?>
                                </div>

                                <div class="col-md-12">
                                    <?php echo $form->labelEx($model,'address'); ?>
                                    <?php echo $form->textField($model,'address', array('class'=>'form-control')); ?>
                                    <?php echo $form->error($model,'address'); ?>
                                </div>

                                <div class="col-md-6">
                                    <?php echo $form->labelEx($model,'email'); ?>
                                    <?php echo $form->textField($model,'email', array('class'=>'form-control')); ?>
                                    <?php echo $form->error($model,'email'); ?>
                                </div>

                                <div class="col-md-6">
                                    <?php echo $form->labelEx($model,'phone'); ?>
                                    <?php echo $form->textField($model,'phone', array('class'=>'form-control')); ?>
                                    <?php echo $form->error($model,'phone'); ?>
                                </div>

                                <div class="col-md-12">
                                    <?php echo $form->labelEx($model,'description'); ?>
                                    <?php echo $form->textField($model,'description', array('class'=>'form-control')); ?>
                                    <?php echo $form->error($model,'description'); ?>
                                </div>

                                <div class="col-md-12">
                                    <?php echo $form->labelEx($model,'about'); ?>
                                    <?php echo $form->textArea($model,'about', array('class'=>'form-control','id'=>'cmtAbout')); ?>
                                    <?php echo $form->error($model,'about'); ?>
                                </div>

                                <div class="col-md-12">
                                    <?php echo $form->labelEx($model,'vision'); ?>
                                    <?php echo $form->textArea($model,'vision', array('class'=>'form-control','id'=>'cmtVision')); ?>
                                    <?php echo $form->error($model,'vision'); ?>
                                </div>

                                <div class="col-md-12">
                                    <?php echo $form->labelEx($model,'diagram'); ?>
                                    <?php echo $form->textArea($model,'diagram', array('class'=>'form-control','id'=>'cmtDiagram')); ?>
                                    <?php echo $form->error($model,'diagram'); ?>
                                </div>

                                <div class="col-md-12">
                                    <?php echo $form->labelEx($model,'benefit'); ?>
                                    <?php echo $form->textArea($model,'benefit', array('class'=>'form-control','id'=>'cmtBenefit')); ?>
                                    <?php echo $form->error($model,'benefit'); ?>
                                </div>


                                <div class="col-md-12">
                                    <hr>
                                    <?php echo CHtml::submitButton('Actualizar', array('class'=>'btn btn-block btn-info')); ?>
                                </div>
                            </div>

                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end col -->
</div>

<script type="text/javascript">

CKEDITOR.replace("cmtAbout",{
    uiColor:'#f3f3f3',
    language:'es',
    toolbar :[['Styles', 'Format'],['Bold', 'Italic', 'Underline', '-', 'NumberedList',
    'BulletedList', '-', 'Link'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['Image','Youtube']]
});
CKEDITOR.replace("cmtVision",{
    uiColor:'#f3f3f3',
    language:'es',
    toolbar :[['Styles', 'Format'],['Bold', 'Italic', 'Underline', '-', 'NumberedList',
    'BulletedList', '-', 'Link'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['Image','Youtube']]
});
CKEDITOR.replace("cmtDiagram",{
    uiColor:'#f3f3f3',
    language:'es',
    toolbar :[['Styles', 'Format'],['Bold', 'Italic', 'Underline', '-', 'NumberedList',
    'BulletedList', '-', 'Link'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['Image','Youtube']]
});
CKEDITOR.replace("cmtBenefit",{
    uiColor:'#f3f3f3',
    language:'es',
    toolbar :[['Styles', 'Format'],['Bold', 'Italic', 'Underline', '-', 'NumberedList',
    'BulletedList', '-', 'Link'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['Image','Youtube']]
});
</script>