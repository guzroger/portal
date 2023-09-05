<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="text-center card-box">
            <div class="member-card">
                <?php $this->renderPartial('profile',array('company'=>$company)); ?>
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->
    <div class="col-lg-8 col-xl-9">
        <div class="">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <?php $this->renderPartial('menu'); ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div id="wrapper">
                            <div class="row scrollbar"  id="style-2">
                                <div class="col-md-12">
                                    <?php echo $company->about; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end col -->
</div>