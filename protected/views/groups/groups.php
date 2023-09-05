<?php 

$this->pageTitle = 'Grupos COMTECO'; 

?>
<div class="row">
    <?php foreach($model as $event){ ?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="text-center card-box">
            <div class="member-card">
                <div class="thumb-lg member-thumb m-b-10 center-page">
                    <img src="<?php echo Yii::app()->createUrl('api/showGroups',array('filename'=>$event->photo)); ?>" class="rounded-circle img-thumbnail" alt="profile-image">
                </div>

                <div class="">
                    <h5 class="m-b-5"><?php echo $event->name; ?></h5>
                    <p class="text-muted"><?php echo $event->description; ?></p>
                </div>

                <a href="<?php echo Yii::app()->createAbsoluteUrl('groups/members',array('cddGr'=>$event->code)); ?>" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light">Miembros</a>
                <?php /*
                <a href="<?php echo Yii::app()->createAbsoluteUrl('groups/calendar',array('cddGr'=>$event->code)); ?>" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light">Calendario</a>
                */ ?>
                <div class="text-left m-t-40">

                    <p class="text-muted font-13"><strong>Nombre :</strong> <span class="m-l-15"><?php echo $event->name; ?></span></p>

                    <p class="text-muted font-13"><strong>Telefono :</strong><span class="m-l-15"><?php echo $event->public_phone; ?></span></p>

                    <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15"><?php echo $event->public_mail; ?></span></p>

                </div>
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
    <?php } ?>
</div>