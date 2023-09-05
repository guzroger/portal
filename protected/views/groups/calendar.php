<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="text-center card-box">
            <div class="member-card">
                <?php $this->renderPartial('profile',array('group'=>$group)); ?>
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
    <div class="col-lg-8 col-xl-9">
        <div class="">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <?php $this->renderPartial('menu',array('manager'=>$manager,'member'=>$member)); ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="col-md-12">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end col -->
</div>