
<div class="row">
    <div class="col-md-12">
        <?php 
        if(isset($_GET['ert'])){
            $error = $_GET['ert'];
            if($error == '-100'){
                echo '<div class="alert alert-danger"><strong>Aviso: </strong> No se pudo guardar la publicaci&oacute;n, Intentelo nuevamente.</div>';
            }elseif($error == '100'){
                echo '<div class="alert alert-success"><strong>Informe: </strong> Se guardo exitosamente la publicaci&oacute;n.</div>';
            }elseif($error == '-1000'){
                echo '<div class="alert alert-danger"><strong>Aviso: </strong> No se pudo crear la publicaci&oacute;n, Intentelo nuevamente.</div>';
            }elseif($error == '-1001'){
                echo '<div class="alert alert-danger"><strong>Aviso: </strong> Grupo no identificado, Intentelo nuevamente.</div>';
            }elseif($error == '1000'){
                echo '<div class="alert alert-success"><strong>Informe: </strong> Se cre&oacute; y publico exitosamente su publicaci&oacute;n.</div>';
            }elseif($error == '1010'){
                echo '<div class="alert alert-success"><strong>Informe: </strong> Se modific&oacute; exitosamente su publicaci&oacute;n.</div>';
            }elseif($error == '-1011'){
                echo '<div class="alert alert-danger"><strong>Aviso: </strong> No se pudo modificar la publicaci&oacute;n. Intentelo nuevamente.</div>';
            }
        }
        ?>
    </div>
    <div class="col-lg-8 col-sm-12 col-xs-12 order-2">
        <?php if($publications['manager'] == 1){ ?>
        <div class="card m-b-20">
            <form id="publicPost" method="POST" action="<?php echo Yii::app()->createUrl('site/publicatePost'); ?>" enctype="multipart/form-data" onsubmit="jQuery('.loader_div').show();">
                <h5 class="card-header">Publicaci&oacute;n</h5>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="postTitle" class="col-form-label">T&iacute;tulo</label>
                            <input type="text" class="form-control" maxlength="50" id="postTitle" name="postTitle"  placeholder="T&iacute;tulo" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="postDescription" class="col-form-label">Publicaci&oacute;n R&aacute;pida (Opcional)</label>
                            <textarea class="form-control" maxlength="450" id="postDescription" name="postDescription" rows="5"></textarea>
                            <span class="help-block"><small></small></span>
                        </div>
                        <?php if($publications['quantity'] == 1){ ?>
                        <div class="form-group col-md-4">
                            <div class="custom-control custom-checkbox" data-toggle="tooltip" data-placement="bottom" title="Marcar como Publicaci&oacute;n Importante! Destacara a las demas publicaciones.">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="pubPriority" value="1">
                                <label class="custom-control-label" for="customCheck1">Importante</label>
                            </div>
                        </div>
                        <?php /*
                        <div class="form-group col-md-4">
                            <div class="custom-control custom-checkbox" data-toggle="tooltip" data-placement="bottom" title="Enviar a Correo Electronico">
                                <input type="checkbox" class="custom-control-input" id="customCheck2" name="pubEmail" value="1">
                                <label class="custom-control-label" for="customCheck2">Correo Electronico</label>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="custom-control custom-checkbox" data-toggle="tooltip" data-placement="bottom" title="Enviar a Whatsapp">
                                <input type="checkbox" class="custom-control-input" id="customCheck3" name="pubWhatsapp" value="1">
                                <label class="custom-control-label" for="customCheck3">Whatsapp</label>
                            </div>
                        </div>
                        */ ?>
                        
                        <input type="hidden" name="postGroup" id="postGroup" value="<?php echo $publications['groups'][0]['code']; ?>" />
                        <?php }else{ ?>
                        <div class="form-group col-md-3">
                            <div class="custom-control custom-checkbox" data-toggle="tooltip" data-placement="bottom" title="Marcar como Publicaci&oacute;n  Importante! Destacara a las demas publicaciones.">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="pubPriority" value="1">
                                <label class="custom-control-label" for="customCheck1">Importante</label>
                            </div>
                        </div>
                        <?php /*
                        <div class="form-group col-md-3">
                            <div class="custom-control custom-checkbox" data-toggle="tooltip" data-placement="bottom" title="Enviar a Correo Electronico">
                                <input type="checkbox" class="custom-control-input" id="customCheck2" name="pubEmail" value="1">
                                <label class="custom-control-label" for="customCheck2">Correo Electronico</label>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="custom-control custom-checkbox" data-toggle="tooltip" data-placement="bottom" title="Enviar a Whatsapp">
                                <input type="checkbox" class="custom-control-input" id="customCheck3" name="pubWhatsapp" value="1">
                                <label class="custom-control-label" for="customCheck3">Whatsapp</label>
                            </div>
                        </div>
                        */ ?>
                        <div class="form-group col-md-9">
                            <select class="custom-select mt-3" name="postGroup" id="postGroup" required>
                                <option value="">Seleccione Grupo</option>
                                <?php foreach($publications['groups'] as $group){ ?>
                                <option value="<?php echo $group['code']; ?>"><?php echo $group['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-icon waves-effect waves-light btn-secondary m-b-5"  data-toggle="modal" data-target="#modalDocument"> 
                        <i class="fa fa-file-word-o"></i> Documento
                    </button>
                    <button type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#modalImage"> 
                        <i class="fa fa-file-image-o"></i> Imagenes
                    </button>  
                    <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-toggle="modal" data-target="#modalFiles"> 
                        <i class="fa fa-file-zip-o"></i> Archivos
                    </button>    
                    
                    <button type="button" class="btn btn-icon waves-effect waves-light btn-dark m-b-5" data-toggle="modal" data-target="#modalVideo"> 
                        <i class="fa fa-file-video-o"></i> Video
                    </button>  
                    
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5 float-right" type="submit" id="btnPublication" name="btnPublication" data-toggle="tooltip" data-placement="bottom" title="Publicar"> 
                        <i class="fa fa-cloud-upload"></i> Publicar
                    </button>  
                    <!--MODALS -->
                    <div id="modalDocument" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDocumentLabel" aria-hidden="true" style="display: none;">
                        <?php $this->renderPartial('publication/pub_document'); ?>
                    </div><!-- /.modal -->
                    <div id="modalImage" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalImageLabel" aria-hidden="true" style="display: none;">
                        <?php $this->renderPartial('publication/pub_images'); ?>
                    </div><!-- /.modal -->
                    <div id="modalFiles" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalFilesLabel" aria-hidden="true" style="display: none;">
                        <?php $this->renderPartial('publication/pub_files'); ?>
                    </div><!-- /.modal -->
                    <div id="modalVideo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalVideoLabel" aria-hidden="true" style="display: none;">
                        <?php $this->renderPartial('publication/pub_video'); ?>
                    </div><!-- /.modal -->
                </div>
            </form>
        </div>
        <?php } ?>

        <?php if(!empty($publications['publications'])){ ?>
            <?php $cantidad = 1; ?>
            <?php foreach($publications['publications'] as $publi){ ?>
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
            	<div class="portlet">
                    <div class="portlet-heading <?php echo $color; ?>">
                        <h3 class="portlet-title">
                            <?php echo $icon; ?><?php echo str_replace('-1', '', $publi['postuni']); ?> - <?php echo $publi['title']; ?>
                        </h3>
                        <div class="portlet-widgets">
                            <?php 
                            $check = GroupUser::model()->findByAttributes(array('group_id'=>$publi['grupoId'],'user_id'=>$model['idInt'], 'manager'=>1,'status'=>1));
                            if(!empty($check)){                            
                            ?>
                            <a href="<?php echo Yii::app()->createUrl('site/publicationUpdate',array('cddPb'=>$publi['id'])); ?>" data-toggle="tooltip" data-placement="bottom" title="Editar Publicaci&oacute;n">
                                <i class="fa fa-edit"></i>
                            </a>
                            <span class="divider"></span>
                            <?php } ?> 
                            <?php if($publi['saved'] == 0){ ?>
                            <a href="<?php echo Yii::app()->createUrl('site/publicationSave',array('cddPb'=>$publi['id'])); ?>" data-toggle="tooltip" data-placement="bottom" title="Guardar Publicaci&oacute;n">
                                <i class="fa fa-save"></i>
                            </a>
                            <span class="divider"></span>
                            <?php } ?>
                            <a href="<?php echo Yii::app()->createUrl('site/publicationView',array('cddPb'=>$publi['id'])); ?>" data-toggle="tooltip" data-placement="bottom" title="Ver Publicaci&oacute;n"><i class="ion-search"></i></a>
                            <span class="divider"></span>
                            <a data-toggle="collapse" data-parent="#publication<?php echo $cantidad; ?>" href="#publicationId<?php echo $cantidad; ?>"><i class="ion-minus-round"></i></a>
                            <span class="divider"></span>
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="publicationId<?php echo $cantidad; ?>" class="panel-collapse collapse show">
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
                                                            <img class="d-block" src="<?php echo Yii::app()->createUrl('api/showPublicationImages',array('filename'=>$imagenes['image'])); ?>" alt="<?php echo $imagenes['image']; ?> " width="80%" />
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
                                                                    <div class="col-md-12">
                                                                        <img class="d-block" src="<?php echo Yii::app()->createUrl('api/showPublicationImages',array('filename'=>$imagenes['image'])); ?>"  width="100%"  alt="<?php echo $imagenes['image']; ?> " />    
                                                                    </div>                                                                    
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
                <?php $cantidad = $cantidad + 1; ?>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="col-lg-4 col-sm-12 col-xs-12 order-1">
        <div class="portlet">
            <div class="portlet-heading bg-info">
                <h3 class="portlet-title">
                    Datos del Tiempo
                </h3>
                <div class="portlet-widgets">
                    <a data-toggle="collapse" class="collapsed hidden-md" data-parent="#accordion2" href="#modal-time"><i class="ion-minus-round"></i></a>
                    <span class="divider hidden-md"></span>
                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="modal-time" class="panel-collapse collapse dont-collapse-md">
                <?php $this->renderPartial('time'); ?>
            </div>
        </div>
        <div class="portlet">
            <div class="portlet-heading bg-danger">
                <h3 class="portlet-title">
                    Mi Portal
                </h3>
                <div class="portlet-widgets">
                    <a data-toggle="collapse" class="collapsed hidden-md" data-parent="#accordion2" href="#bg-dark"><i class="ion-minus-round"></i></a>
                    <span class="divider hidden-md"></span>
                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="bg-dark" class="panel-collapse collapse dont-collapse-md">
                <div class="portlet-body">
                    <div class="col-12">
                        <h4>Mi Perfil</h4>
                        <div class="card-box widget-user">
                            <div>
                                <img src="<?php echo Yii::app()->createUrl('api/showPersonal',array('filename'=>$model['foto'])); ?>" class="rounded-circle" alt="user" data-toggle="tooltip" data-placement="right" title="<?php echo $model['nombre']; ?>">
                                <div class="wid-u-info">
                                    <h5 class="mt-0 m-b-5 font-16"><?php echo $model['nombre']; ?></h5>
                                    <p class="text-muted m-b-5 font-13">ITEM: <?php echo $model['item']; ?></p>
                                    <a href="<?php echo Yii::app()->createAbsoluteUrl('profile/profile'); ?>" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5">Mi Perfil</a>
                                </div>
                            </div>
                        </div>
                        <h4>Mi Empresa</h4>
                        <div class="card-box widget-user">
                            <div>
                                <img src="<?php echo Yii::app()->createUrl('api/showCompany',array('filename'=>$company->photo)); ?>" class="rounded-circle" alt="user" data-toggle="tooltip" data-placement="right" title="<?php echo $company->name; ?>">
                                <div class="wid-u-info">
                                    <h5 class="mt-0 m-b-5 font-16"><?php echo $company->name; ?></h5>
                                    <a href="<?php echo Yii::app()->createAbsoluteUrl('company/index'); ?>" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5">Visitar</a>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($publications['groups'])){ ?>
                            <h4>Mi Grupos</h4>
                            <?php foreach($publications['groups'] as $grupos){ ?>
                                <div class="card-box widget-user">
                                    <div>
                                        <img src="<?php echo Yii::app()->createUrl('api/showGroups',array('filename'=>$grupos['photo'])); ?>" class="rounded-circle" alt="user" data-toggle="tooltip" data-placement="right" title="<?php echo $grupos['name']; ?>">
                                        <div class="wid-u-info">
                                            <h5 class="mt-0 m-b-5 font-16"><?php echo $grupos['name']; ?></h5>
                                            <p class="text-muted m-b-5 font-13">Cantidad de Miembros: <?php echo $grupos['quantity']; ?></p>
                                            <a href="<?php echo Yii::app()->createAbsoluteUrl('groups/index',array('cddGr'=>$grupos['code'])); ?>" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5">Visitar</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="portlet">
            <div class="portlet-heading bg-dark">
                <h3 class="portlet-title">
                    Herramientas
                </h3>
                <div class="portlet-widgets">
                    <a data-toggle="collapse" class="collapsed hidden-md" data-parent="#accordion2" href="#toolsPortlet"><i class="ion-minus-round"></i></a>
                    <span class="divider hidden-md"></span>
                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="toolsPortlet" class="panel-collapse collapse dont-collapse-md">
                <div class="portlet-body">
                    <div class="row">
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('groups/groups'); ?>" class="btn btn-icon btn-outline-dark col-lg-4">
                            <i class="fa fa-users fa-2x"></i><br>Grupos<br>COMTECO
                        </a>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('groups/directory'); ?>" onclick="jQuery('.loader_div').show();" class="btn btn-icon btn-outline-dark col-lg-4">
                            <i class="fa fa-phone-square fa-2x"></i><br>Directorio<br>COMTECO
                        </a><br>
                        <?php /*
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('medical/personal'); ?>" class="btn btn-icon btn-outline-dark col-lg-4">
                            <i class="fa fa-user-md fa-2x"></i><br>Consulta <br>M&eacute;dica
                        </a>
                        <a href="#" class="btn btn-icon btn-outline-dark col-lg-4">
                            <i class="fa fa-line-chart fa-2x"></i><br>Indicadores <br>Laborales
                        </a>
                        <a href="#" class="btn btn-icon btn-outline-dark col-lg-4">
                            <i class="fa fa-puzzle-piece fa-2x"></i><br>GSI <br> COMTECO
                        </a>
                        <a href="#" class="btn btn-icon btn-outline-dark col-lg-4">
                            <i class="fa fa-rocket fa-2x"></i><br>Solicitar <br>Permiso
                        </a>
                        */ ?>
                    </div>    
                </div>
            </div>
        </div>
    	<div class="portlet">
            <div class="portlet-heading bg-pink">
                <h3 class="portlet-title">
                    Cumplea&ntilde;eros del D&iacute;a
                </h3>
                <div class="portlet-widgets">
                    <a data-toggle="collapse" class="collapsed hidden-md" data-parent="#accordion2" href="#bg-pink"><i class="ion-minus-round"></i></a>
                    <span class="divider hidden-md"></span>
                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="bg-pink" class="panel-collapse collapse dont-collapse-md">
                <div class="portlet-body">
                    <div class="col-12">
                        <div class="card m-b-20">
                        <?php if(!empty($birthdays)){ ?>
                            <?php $cumpleaños = 'birthday.jpg'; ?>
                            <img class="card-img-top img-fluid" src="<?php echo Yii::app()->createAbsoluteUrl('api/showGallery',array('filename'=>$cumpleaños)); ?>" alt="Card image cap">
                            <ul class="list-group list-group-flush">
                                <?php foreach($birthdays as $birth){ ?>
                                    <li class="list-group-item">
                                        <?php echo $birth['name']; ?>
                                        <?php /*
                                        <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5 float-right"  data-toggle="tooltip" data-placement="right" title="Enviale una Postal"> <i class="fa fa-paper-plane"></i> </button>
                                        */ ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php }else{ ?>
                            <?php $cumpleaños = 'nobirthday.jpg'; ?>
                            <img class="card-img-top img-fluid" src="<?php echo Yii::app()->createAbsoluteUrl('api/showGallery',array('filename'=>$cumpleaños)); ?>" alt="Card image cap">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">No existen Cumplea&ntilde;eros el d&iacute;a de hoy! Feliz no Cumplea&ntilde;os a Todos!!!</li>
                            </ul>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#postDescription').on('keyup',function(){
    var input = $(this);
    input.next("span").text(input.val().length + " /450 Caractares");
});


CKEDITOR.replace("postDocument",{
    uiColor:'#f3f3f3',
    language:'es',
    toolbar :[['Styles', 'Format'],['Bold', 'Italic', 'Underline', '-', 'NumberedList',
    'BulletedList', '-', 'Link'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['Image','Youtube']]
});
</script>
