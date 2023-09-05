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
                                <h4>Publicaciones Guardadas</h4>
                            </div>   
                            <div class="col-md-12">
                                <?php 
                                if(isset($_GET['ert'])){
                                    $error = $_GET['ert'];
                                    if($error == '-100'){
                                        echo '<div class="alert alert-danger"><strong>Aviso: </strong> No se pudo eliminar la publicaci&oacute;n, Intentelo nuevamente.</div>';
                                    }elseif($error == '100'){
                                        echo '<div class="alert alert-success"><strong>Informe: </strong> Se elimino exitosamente la publicaci&oacute;n.</div>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-md-12"> 
                                <div id="wrapper">
                                    <div class="row scrollbar"  id="style-2">
                                        <?php if(!empty($publications['publications'])){ ?>
                                                <?php foreach($publications['publications'] as $publication){ ?>
                                                    <div class="col-md-12">
                                                        <div class="widget-bg-color-icon card-box">
                                                            <div class="row">
                                                                <div class="col-md-2" align="center"> 
                                                                    <div class="bg-icon bg-icon-purple">
                                                                        <i class="mdi mdi-file-document-box text-purple"></i>
                                                                    </div>
                                                                    <br>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <h5 class="mt-0 m-b-5 font-16">Titulo: <?php echo $publication['title'];?></h5>
                                                                    <p class="text-muted m-b-5 font-16">Fecha: <?php echo $publication['date_register'];?></p>
                                                                    <p class="text-muted m-b-5 font-16">Publicado Por: <?php echo $publication['postby'];?></p>
                                                                    <p class="text-muted m-b-5 font-16">Grupo: <?php echo $publication['groupName'];?></p>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a href="<?php echo Yii::app()->createUrl('profile/unsave',array('cddPb'=>$publication['id'])); ?>" class="btn btn-danger btn-custom m-b-5"><i class="fa fa-trash"></i> Eliminar</a>
                                                                    <a href="<?php echo Yii::app()->createUrl('site/publicationView',array('cddPb'=>$publication['id'])); ?>" class="btn btn-success btn-custom m-b-5"><i class="fa fa-eye"></i> Ver Publicaci&oacute;n</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                        <?php }else{ ?>
                                            <div class="col-md-12">
                                                <h3>NO TIENE PUBLICACIONES GUARDADAS.</h3>
                                            </div>
                                        <?php } ?>
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