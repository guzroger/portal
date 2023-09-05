<div class="thumb-xl member-thumb m-b-10 center-block">
    <img src="<?php echo Yii::app()->createUrl('api/showGroups',array('filename'=>$group->photo)); ?>" width="300" class="rounded-circle img-thumbnail" alt="profile-image">
</div>

<div class="">
    <h5 class="m-b-5"><?php echo $group->name; ?></h5>
    <p class="text-muted"><?php echo $group->description; ?></p>
</div>

<hr>

<div class="text-left m-t-40">
    <p class="text-muted font-13"><strong>Nombre :</strong> <span class="m-l-15"><?php echo $group->name; ?></span></p>

    <p class="text-muted font-13"><strong>Telefono :</strong><span class="m-l-15"><?php echo $group->public_phone; ?></span></p>

    <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15"><?php echo $group->public_mail; ?></span></p>

</div>

