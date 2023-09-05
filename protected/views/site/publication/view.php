<?php
if($publi['date_update'] != null){
    $fecha = date('d/m/Y H:i',strtotime($publi['date_update']));
}else{
    $fecha = date('d/m/Y H:i',strtotime($publi['date_register']));
}

if($publi['priority'] == 1){
   $color = 'bg-danger';
   $icon = '<i class="ion-pin fa-lg"></i> ';
}else{
    $color = 'bg-info';
    $icon = '';
}

?>
<div class="col-md-12">
    <div class="portlet">
        <div class="portlet-heading <?php echo $color; ?>">
            <h3 class="portlet-title">
                <?php echo $icon; ?><?php echo str_replace('-1', '', $publi['postuni']); ?> - <?php echo $publi['title']; ?>
            </h3>
            <div class="portlet-widgets">
                <a href="<?php echo Yii::app()->createUrl('site/publicationSave',array('cddPb'=>$publi['id'])); ?>" data-toggle="tooltip" data-placement="bottom" title="Guardar Publicaci&oacute;n">
                    <i class="fa fa-save"></i>
                </a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#publication" href="#publicationId"><i class="ion-minus-round"></i></a>
                <span class="divider"></span>
                <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="publicationId" class="panel-collapse collapse show">
            <div class="portlet-body">
                <div class="col-md-12">
                    <i class="fa fa-calendar"></i> <?php echo $fecha; ?> <br>
                    <i class="fa fa-user"></i> Publicado Por: <?php echo $publi['postby']; ?> <br>
                    <hr>
                    <?php if($publi['video'] != null){ ?>
                        <div class="col-md-12" align="center">
                            <iframe width="100%" height="350" src="https://www.youtube.com/embed/<?php echo $publi['video']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    <?php } ?>
                    <?php if($publi['video_url'] != null){ ?>
                        <div class="col-md-12" align="center">
                            <video width="70%" controls>
                                <source src="<?php echo Yii::app()->createUrl('api/showPublicationVideo',array('filename'=>$publi['video'])); ?>" type="video/mp4">
                            </video>
                        </div>
                    <?php } ?>
                    <?php if($publi['image'] == 1){ 
                        $inicial = 1;
                        $inicialImg = 1;
                        $dataSlide = 0;
                        ?>
                        <div id="carouselPublication<?php echo $publi['id']; ?>" class="carousel slide carousel-fade" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php foreach($publi['images'] as $imagenes){ ?>
                                    <?php if($dataSlide == 0){ 
                                        $activeImgSl = 'class="active"';
                                    }else{ 
                                        $activeImgSl = '';
                                    } ?>
                                        <li data-target="#carouselPublication<?php echo $publi['id']; ?>" data-slide-to="<?php echo $dataSlide; ?>" <?php echo $activeImgSl; ?>></li>
                                    <?php $dataSlide = $dataSlide + 1; ?>
                                <?php } ?>
                            </ol>
                            <div class="carousel-inner" role="listbox" align="center">
                                <?php foreach($publi['images'] as $imagenes){ ?>
                                        <?php if($inicialImg == 1){ 
                                            $activeImg = 'active';
                                        }else{ 
                                            $activeImg = '';
                                        } ?>
                                        <div class="carousel-item <?php echo $activeImg; ?>">
                                            <a href="#" data-toggle="modal" data-target="#modalImage<?php echo $imagenes['id']; ?>">
                                                <img class="d-block" src="<?php echo Yii::app()->createUrl('api/showPublicationImages',array('filename'=>$imagenes['image'])); ?>" alt="<?php echo $imagenes['image']; ?> " height="500" />
                                            </a>
                                        </div>
                                        <div id="modalImage<?php echo $imagenes['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDocumentLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title" id="full-width-modalLabel">Imagen</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img class="d-block" src="<?php echo Yii::app()->createUrl('api/showPublicationImages',array('filename'=>$imagenes['image'])); ?>" alt="<?php echo $imagenes['image']; ?> " />
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    <?php $inicialImg = $inicialImg + 1; ?>
                                <?php } ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselPublication<?php echo $publi['id']; ?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselPublication<?php echo $publi['id']; ?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($publi['description'] != null){ ?>
                        <p><i class="fa fa-sticky-note"></i> <?php echo $publi['description']; ?></p>
                    <?php } ?>
                    <?php if($publi['document'] != null){ ?>
                        <p><?php echo $publi['document']; ?></p>
                    <?php } ?>
                    <?php if($publi['files'] == 1){ ?>
                    <h3><i class="fa fa-folder"></i> Archivos Adjuntos </h3>     
                    <div class="row">
                        <?php foreach($publi['folder'] as $archivos){ ?>
                            <div class="col-md-3">
                                <h4>                                           
                                    <i class="fa fa-file-zip-o"></i> 
                                    <a href="<?php echo Yii::app()->createUrl('api/showPublicationFiles',array('filename'=>$archivos['file'])); ?>"><?php echo urldecode($archivos['name']); ?></a>
                                </h4>
                            </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
</div>