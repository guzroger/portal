<div class="row">
    <div class="col-lg-12">
        <div class="">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <?php $this->renderPartial('menu'); ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="managerial" role="tablist" aria-multiselectable="true" class="m-b-20">
                                    <div class="card">
                                        <div class="card-header" role="tab" id="headingOne">
                                            <h5 class="mb-0 mt-0 font-16">
                                                <a data-toggle="collapse" data-parent="#managerial" href="#graficoUno" aria-expanded="true" aria-controls="graficoUno">
                                                    GRAFICO 1
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="graficoUno" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="card-body">
                                                <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#modalUno"><i class="fa fa-arrows-alt"></i> Pantall Completa</button>

                                                <iframe src="<?php echo $this->createUrl('commercialUno'); ?>" frameborder="0" style="overflow-x:hidden;overflow-y:scroll;height:500px;width:100%;" height="100%" width="100%"></iframe>

                                                <div id="modalUno" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalUnoLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-full">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title" id="modalUnoLabel">Grafico 1</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-lg-12">
                                                                    <iframe src="<?php echo $this->createUrl('commercialUno'); ?>" frameborder="0" style="overflow-x:hidden;overflow-y:scroll;height:500px;width:100%;" height="100%" width="100%"></iframe>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
