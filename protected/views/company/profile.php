<?php
$criteria = new CDbCriteria(); 

$criteria->addCondition('company_id=1');
$criteria->addCondition('status=1');

$social = CompanySocial::model()->findAll($criteria);
?>

<div class="thumb-xl member-thumb m-b-10 center-block">
    <img src="<?php echo Yii::app()->createUrl('api/showCompany',array('filename'=>$company->photo)); ?>" width="300" class="rounded-circle img-thumbnail" alt="profile-image">
</div>

<div class="">
    <h5 class="m-b-5"><?php echo $company->name; ?></h5>
    <p class="text-muted"><?php echo $company->description; ?></p>
</div>

<hr>

<div class="text-left m-t-40">
    <p class="text-muted font-13"><strong>Nombre :</strong> <span class="m-l-15"><?php echo $company->name; ?></span></p>

    <p class="text-muted font-13"><strong>Telefono :</strong><span class="m-l-15"><?php echo $company->phone; ?></span></p>

    <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15"><?php echo $company->email; ?></span></p>

    <p class="text-muted font-13"><strong>Direcci&oacute;n :</strong> <span class="m-l-15"><?php echo $company->address; ?></span></p>
</div>

<ul class="social-links list-inline m-t-30">
    <?php foreach ($social as $value) { ?>
    <li class="list-inline-item">
        <a target="_blank" title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="<?php echo $value->url; ?>" data-original-title="<?php echo $value->name; ?>">
            <i class="fa <?php echo $value->icon; ?>"></i>
        </a>
    </li>
    <?php } ?>
</ul>