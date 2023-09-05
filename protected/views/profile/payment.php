<div class="row">
    <div class="col-xl-3 col-xs-12  order-2">
        <div class="text-center card-box">
            <div class="member-card">
                <?php $this->renderPartial('info',array('model'=>$model)); ?>
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
    <div class="col-xl-9 col-xs-12  order-1 order-xl-9">
        <div class="">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <?php $this->renderPartial('menu'); ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="row">  
                            <div class="col-md-12">
                                <h4>Mis Planillas</h4>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>