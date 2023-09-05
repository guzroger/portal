<?php 
$criteriaImage = new CDbCriteria(); 

$criteriaImage->addCondition('publication_id='.$publi['id']);

$criteriaImage->addCondition('status != 3');

$imagenes = PublicationImage::model()->findAll($criteriaImage);

$criteriaFiles = new CDbCriteria(); 

$criteriaFiles->addCondition('publication_id='.$publi['id']);

$criteriaFiles->addCondition('status != 3');

$archivos = PublicationFile::model()->findAll($criteriaFiles);	

?>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
    		<form method="POST" action="<?php echo Yii::app()->createUrl('site/publicatePostUpdate'); ?>" enctype="multipart/form-data" onsubmit="jQuery('.loader_div').show();">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="postTitle" class="col-form-label">T&iacute;tulo</label>
                            <input type="text" class="form-control" maxlength="50" id="postTitle" name="postTitle" value="<?php echo $publi['title']; ?>"  placeholder="T&iacute;tulo" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="postDescription" class="col-form-label">Publicaci&oacute;n R&aacute;pida (Opcional)</label>
                            <textarea class="form-control" maxlength="450" id="postDescription" name="postDescription" rows="5"><?php echo $publi['description']; ?></textarea>
                            <span class="help-block"><small></small></span>
                        </div>
                        <?php 

                        if($publi['priority'] == 1){
                        	$marcar = 'checked';
                        }else{
                        	$marcar = '';
                        }

                        ?>
                        <div class="form-group col-md-3">
                            <div class="custom-control custom-checkbox" data-toggle="tooltip" data-placement="bottom" title="Marcar como Publicaci&oacute;n Importante! Destacara a las demas publicaciones.">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="pubPriority" value="1" <?php echo $marcar; ?> >
                                <label class="custom-control-label" for="customCheck1">Importante</label>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                        	<label>Estado</label>
                        	<select class="custom-select" name="postStatus" id="postStatus" required>
                                <option value="1">ACTIVO</option>
                                <option value="0">INACTIVO</option>
                            </select>
                        </div>
                        <input type="hidden" name="postPub" id="postPub" value="<?php echo $_GET['cddPb']; ?>">
                        <input type="hidden" name="postGroup" id="postGroup" value="<?php echo $publi['groupId']; ?>">
                    </div>
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
                        <i class="fa fa-cloud-upload"></i> Actualizar
                    </button>  
                    <!--MODALS -->
                    <div id="modalDocument" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDocumentLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-full">
						    <div class="modal-content">
						        <div class="modal-header">
						            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						            <h4 class="modal-title" id="full-width-modalLabel">Documento</h4>
						        </div>
						        <div class="modal-body">
						            <textarea class="form-control" id="postDocument" name="postDocument" rows="5"><?php echo $publi['document']; ?></textarea>
						        </div>
						        <div class="modal-footer">
						            <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">Guardar</button>
						        </div>
						    </div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
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
	</div>
	<div class="col-md-12">
	    <div class="card-box row">
			<div class="col-lg-4 col-sm-12">
				<h4>Video</h4>
				<?php if($publi['video'] != null){ ?>
                    <div class="col-md-12" align="center">
                        <?php /*
                        <video width="70%" controls>
                            <source src="<?php echo Yii::app()->createUrl('api/showPublicationVideo',array('filename'=>$publi['video'])); ?>" type="video/mp4">
                        </video>
                        */?>
                        <iframe width="100%" height="350" src="https://www.youtube.com/embed/<?php echo $publi['video']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <br>
                        <a class="btn btn-icon waves-effect waves-light btn-danger m-b-5 text-light" onclick="$('#modalDeleteVideo').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-trash"></i> Eliminar</a>
                    	<!--MODALS -->
                        <div id="modalDeleteVideo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="full-width-modalLabel">Eliminar Imagen</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <h2>ESTA SEGURO DE ELIMINAR ESTE VIDEO?</h2>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="deleteVideo('<?php echo $publi['id']; ?>');" >SI</button>
                                        <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">NO</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog  modal-lg -->
                        </div><!-- /.modal -->
                    </div>
                <?php }else{ ?>
                <h5>NO EXISTE VIDEO CARGADO</h5>
                <?php } ?>
			</div>
			<div class="col-lg-4 col-sm-12">
				<h4>Imagenes Cargadas</h4>
				<?php if(!empty($imagenes)){ ?>
		    		<div class="table-responsive">
		                <table class="table table-striped table-bordered">
		                    <thead>
		                        <tr>
		                            <th>Fecha Registro</th>
		                            <th>Imagen</th>
		                            <th>Acciones</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	<?php foreach($imagenes as $imagen){ ?>
		                    		<tr>
		                    			<td><?php echo date('d/m/Y',strtotime($imagen->date_register)); ?></td>
		                    			<td>
		                                    <a href="#" data-toggle="modal" data-target="#modalImage<?php echo $imagen->id; ?>">
		                    					<img class="d-block" src="<?php echo Yii::app()->createUrl('api/showPublicationImages',array('filename'=>$imagen->image)); ?>" alt="<?php echo $imagen->image; ?> " width="100px" />
		                					</a>
		                    			</td>
		                    			<td>
		                    				<a class="btn btn-icon waves-effect waves-light btn-danger m-b-5 text-light" onclick="$('#modalDeleteImage<?php echo $imagen->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-trash"></i> Eliminar</a>
		                    			</td>
		                    		</tr>
		        					<div id="modalImage<?php echo $imagen->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDocumentLabel" aria-hidden="true" style="display: none;">
		                                <div class="modal-dialog modal-lg">
		                                    <div class="modal-content">
		                                        <div class="modal-header">
		                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		                                            <h4 class="modal-title" id="full-width-modalLabel">Imagen</h4>
		                                        </div>
		                                        <div class="modal-body" align="center">
		                                            <img class="d-block" src="<?php echo Yii::app()->createUrl('api/showPublicationImages',array('filename'=>$imagen->image)); ?>" alt="<?php echo $imagen->image; ?> " />
		                                        </div>
		                                    </div><!-- /.modal-content -->
		                                </div><!-- /.modal-dialog -->
		                            </div><!-- /.modal -->
	                            	<!--MODALS -->
                                    <div id="modalDeleteImage<?php echo $imagen->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog  modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="full-width-modalLabel">Eliminar Imagen</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <h2>ESTA SEGURO DE ELIMINAR ESTA IMAGEN?</h2>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="deleteImages('<?php echo $imagen->id; ?>','<?php echo $imagen->publication_id; ?>');" >SI</button>
                                                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">NO</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog  modal-lg -->
                                    </div><!-- /.modal -->
		                    	<?php } ?>
		                    </tbody>
		                </table>
		            </div>
				<?php }else{ ?>
					<h5>NO EXISTEN IMAGENES CARGADAS</h5>
				<?php } ?> 
			</div> 
			<div class="col-lg-4 col-sm-12">
				<h4>Archivos Cargados</h4>
				<?php if(!empty($archivos)){ ?>
		    		<div class="table-responsive">
		                <table class="table table-striped table-bordered">
		                    <thead>
		                        <tr>
		                            <th>Fecha Registro</th>
		                            <th>Archivo</th>
		                            <th>Acciones</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	<?php foreach($archivos as $archivo){ ?>
		                    		<tr>
		                    			<td><?php echo date('d/m/Y',strtotime($archivo->date_register)); ?></td>
		                    			<td>
		                    				<a href="<?php echo Yii::app()->createUrl('api/showPublicationFiles',array('filename'=>$archivo->file)); ?>"><?php echo urldecode($archivo->name); ?></a>
		                    			</td>
		                    			<td>
		                    				<a class="btn btn-icon waves-effect waves-light btn-danger m-b-5 text-light" onclick="$('#modalDeleteFile<?php echo $archivo->id; ?>').modal('show');" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-trash"></i> Eliminar</a>
		                    			</td>
		                    		</tr>
	                            	<!--MODALS -->
                                    <div id="modalDeleteFile<?php echo $archivo->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog  modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="full-width-modalLabel">Eliminar Archivo</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <h2>ESTA SEGURO DE ELIMINAR ESTE ARCHIVO?</h2>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="deleteFiles('<?php echo $archivo->id; ?>','<?php echo $archivo->publication_id; ?>');" >SI</button>
                                                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" aria-hidden="true">NO</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog  modal-lg -->
                                    </div><!-- /.modal -->
		                    	<?php } ?>
		                    </tbody>
		                </table>
		            </div>   
				<?php }else{ ?>
				<h5>NO EXISTEN ARCHIVOS CARGADOS</h5>
				<?php } ?>         		
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

function deleteFiles(value1, value2)
{
  	$.ajax({
      	type: 'POST',
      	url: "<?php echo Yii::app()->createUrl('site/deleteFiles'); ?>",
      	dataType: "json",          
      	data: {
      	    'codId' : value1,
      	    'codFl' : value2,
      	},
      	success: function (output) {
      	  	if(output.error == 0){
	            jQuery(".loader_div").hide();
	            window.location.href = "index.php?r=site/index";
	        }else if(output.error == 1){
	            jQuery(".loader_div").hide();
	            window.location.href = "index.php?r=site/publicationUpdate&cddPb="+output.token;
	        }
      	}
    });
}

function deleteImages(value1, value2)
{
  	$.ajax({
      	type: 'POST',
      	url: "<?php echo Yii::app()->createUrl('site/deleteImages'); ?>",
      	dataType: "json",          
      	data: {
      	    'codId' : value1,
      	    'codFl' : value2,
      	},
      	success: function (output) {
      	  	if(output.error == 0){
	            jQuery(".loader_div").hide();
	            window.location.href = "index.php?r=site/index";
	        }else if(output.error == 1){
	            jQuery(".loader_div").hide();
	            window.location.href = "index.php?r=site/publicationUpdate&cddPb="+output.token;
	        }
      	}
    });
}

function deleteVideo(value1)
{
  	$.ajax({
      	type: 'POST',
      	url: "<?php echo Yii::app()->createUrl('site/deleteVideo'); ?>",
      	dataType: "json",          
      	data: {
      	    'codId' : value1,
      	},
      	success: function (output) {
      	  	if(output.error == 0){
	            jQuery(".loader_div").hide();
	            window.location.href = "index.php?r=site/index";
	        }else if(output.error == 1){
	            jQuery(".loader_div").hide();
	            window.location.href = "index.php?r=site/publicationUpdate&cddPb="+output.token;
	        }
      	}
    });
}
</script>