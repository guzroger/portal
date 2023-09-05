<style type="text/css">
input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(3); /* IE */
  -moz-transform: scale(3); /* FF */
  -webkit-transform: scale(3); /* Safari and Chrome */
  -o-transform: scale(3); /* Opera */
  transform: scale(3);
  padding: 20px;
  margin-top: 10px;
}
</style>

<?php 
$check = Covid::model()->findByAttributes(array('item'=>$model['item'],'is_titular'=>1,'status'=>1));
?>
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <div class="">
            <div class="card-box">
            <?php if(Yii::app()->user->checkAccess('covid_admin')){ ?>
            	<form method="POST" onsubmit="jQuery('.loader_div').show();">
            		<div class="form-group row mb-3">
                        <label class="col-md-3 col-form-label" for="search_item">Item</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="search_item" name="search_item" placeholder="<?php echo $model['item']; ?>" value="" required>
                        </div>
                        <div class="col-md-3">
                        	<button class="btn btn-block btn-success" id="searchBtn" name="searchBtn">Buscar</button>
                        </div>
                    </div> 
            	</form>
            <?php } ?>
	            <form class="row" method="POST" onsubmit="jQuery('.loader_div').show();">
	            	<div class="col-md-12" align="center">
	        			Formulario de Pre Registro para las vacunas COVID-19, por favor complete sus datos personales y seleccione a sus dependientes que quieran obtener la vacuna COVID.<br>
	        			<b>Nota: La vacuna solo se puede administrar a personas mayores de 18 a&ntilde;os.</b>
	            	</div>
	            	<?php if(!empty($check)){ ?>
	            	<div class="col-md-12 text-danger" align="center">
	            		<br>
	        			<h3>USTED YA SE ENCUENTRA REGISTRADO PARA LA VACUNACIÓN COVID 19</h3>
	            	</div>
	            	<?php } ?>

	            	<?php if(isset($_GET['er'])){ ?>
		            	<div class="col-md-12">
		            		<?php if($_GET['er'] == 0){ ?>
		            			<div class="alert alert-success" role="alert">
		            				Nota: <?php echo $_GET['msg']; ?>
								</div>
		            		<?php }else{ ?>
		            			<div class="alert alert-danger" role="alert">
		            				Nota: <?php echo $_GET['msg']; ?>
								</div>

		            		<?php } ?>
		            	</div>
	            	<?php } ?>
	            	<div class="col-md-12">
	        			<hr>
	        			<h4>Datos de Funcionario Titular:</h4>
	                    <div class="form-group row mb-3">
	                        <label class="col-md-3 col-form-label" for="reg_name">Nombre Completo</label>
	                        <div class="col-md-9">
	                            <input type="text" class="form-control" id="reg_name" name="reg_name" placeholder="Nombre Completo" value="<?php echo $model['name']; ?>" readonly required>
	                        </div>
	                    </div>  
	                    <div class="form-group row mb-3">
	                        <label class="col-md-3 col-form-label" for="reg_item">Item</label>
	                        <div class="col-md-9">
	                            <input type="text" class="form-control" id="reg_item" name="reg_item" placeholder="Item" value="<?php echo $model['item']; ?>" readonly required>
	                        </div>
	                    </div>  

	                    <div class="form-group row mb-3">
	                        <label class="col-md-3 col-form-label" for="reg_doc">N° Documento de Identidad</label>
	                        <div class="col-md-9">
	                            <input type="text" class="form-control" id="reg_doc" name="reg_doc" placeholder="N° Documento de Identidad" value="<?php echo $model['document']; ?>" readonly required>
	                        </div>
	                    </div>  

	                    <div class="form-group row mb-3">
	                        <label class="col-md-3 col-form-label" for="reg_birth">Fecha Nacimiento</label>
	                        <div class="col-md-9">
	                            <input type="text" class="form-control" placeholder="dd/mm/aaaa" value="<?php echo date('d/m/Y',strtotime($model['birthday'])); ?>" readonly required>

	                            <input type="hidden" class="form-control" id="reg_birth" name="reg_birth" placeholder="dd/mm/aaaa" value="<?php echo $model['birthday']; ?>" readonly required>
	                        </div>
	                    </div>  

	                    <div class="form-group row mb-3">
	                        <label class="col-md-3 col-form-label" for="reg_age">Edad</label>
	                        <div class="col-md-9">
	                            <input type="text" class="form-control" id="reg_age" name="reg_age" placeholder="Edad" value="<?php echo (int)$model['age']; ?>" readonly required>
	                        </div>
	                    </div>  

	                    <div class="form-group row mb-3">
	                        <label class="col-md-3 col-form-label" for="reg_phone">Telefono o Celular</label>
	                        <div class="col-md-9">
	                            <input type="text" class="form-control" maxlength="80" id="reg_phone" name="reg_phone" placeholder="Telefono o Celular" value="<?php echo $model['phone']; ?>" required>
	                        </div>
	                    </div>  

	                    <div class="form-group row mb-3">
	                        <label class="col-md-3 col-form-label" for="reg_enf">Enfermedad de Base</label>
	                        <div class="col-md-9">                   
	                            <select class="form-control" id="reg_enf" name="reg_enf">
	                            	<?php foreach($sick as $sk){ 
	                            		if($sk['value'] == $model['sick']){
	                            			$sel = 'selected';
	                            		}else{
	                            			$sel = '';
	                            		}
	                            		?>
	                            		<option value="<?php echo $sk['value']; ?>" <?php echo $sel; ?> ><?php echo $sk['name']; ?></option>	                            	
	                            	<?php } ?>
								</select>
	                        </div>
	                    </div> 
	            	</div>
	            	<?php if(!empty($model['dependents'])){ ?>
	            	<div class="col-md-12">
	        			<hr>
	        			<h4>Dependientes:</h4>
	        			<div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size: 12px;" cellspacing="0" width="100%">
                                <thead>
                                    <th></th>
                                    <th>Seleccionar</th>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Edad</th>
                                    <th>Telefono</th>
                                    <th>Enfemedad de Base</th>
                                    <th>Estado</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    	foreach($model['dependents'] as $dependents) {
                                    		if((int)$dependents['age'] >= 18){

                                    			$check1 = Covid::model()->findByAttributes(array('item'=>$model['item'],'patient_id'=>$dependents['patient_id'],'status'=>1));
                                    		?> 
		                                    <tr>
		                                        <td><?php echo $count; ?></td>
		                                        <td align="center">
			                                        	<?php if($dependents['verificate'] == 1){ ?>
			                                        		<input type="checkbox" id="cbox<?php echo $dependents['patient_id']; ?>" name="dependentsId[]" value="<?php echo $dependents['patient_id']; ?>" onclick="return false;" checked readonly>
			                                        	<?php }else{ ?>
			                                        		<input type="checkbox" id="cbox<?php echo $dependents['patient_id']; ?>" name="dependentsId[]" value="<?php echo $dependents['patient_id']; ?>" onclick="verificateDependent(this.value);">
			                                        	<?php } ?>		            	
		                                        </td>
		                                        <td>
		                                        	<?php echo $dependents['name']; ?>
		                                        	<input type="hidden" class="form-control" id="dep_name<?php echo $dependents['patient_id']; ?>" name="dep_name<?php echo $dependents['patient_id']; ?>" value="<?php echo $dependents['name']; ?>" readonly required>
	                                        	</td>
		                                        <td>		                                        
		                                        	<input type="text" class="form-control" id="dep_doc<?php echo $dependents['patient_id']; ?>" name="dep_doc<?php echo $dependents['patient_id']; ?>" placeholder="N° Documento" value="<?php echo $dependents['document']; ?>" >
		                                        </td>
		                                        <td>
		                                        	<?php echo date('d/m/Y',strtotime($dependents['birthday'])); ?>
													<input type="hidden" class="form-control" id="dep_birth<?php echo $dependents['patient_id']; ?>" name="dep_birth<?php echo $dependents['patient_id']; ?>" value="<?php echo $dependents['birthday']; ?>" readonly required>
		                                        </td>
		                                        <td>
		                                        	<?php echo (int)$dependents['age']; ?>
		                                        	<input type="hidden" class="form-control" id="dep_age<?php echo $dependents['patient_id']; ?>" name="dep_age<?php echo $dependents['patient_id']; ?>" value="<?php echo (int)$dependents['age']; ?>" readonly required>
	                                        	</td>
		                                        <td>
		                                        	<input type="text" class="form-control" id="dep_phone<?php echo $dependents['patient_id']; ?>" name="dep_phone<?php echo $dependents['patient_id']; ?>" placeholder="Telefono" value="<?php echo $dependents['phone']; ?>" >
	                                        	</td>
		                                        <td>
		                                        	<select class="form-control" id="dep_sick<?php echo $dependents['patient_id']; ?>" name="dep_sick<?php echo $dependents['patient_id']; ?>">
						                            	<?php foreach($sick as $sk){ 
						                            		if($sk['value'] == $dependents['sick']){
						                            			$sel = 'selected';
						                            		}else{
						                            			$sel = '';
						                            		}
						                            		?>
						                            		<option value="<?php echo $sk['value']; ?>" <?php echo $sel; ?> ><?php echo $sk['name']; ?></option>	                            	
						                            	<?php } ?>
													</select>
	                                        	</td>
	                                        	<td>
	                                        		<?php if(!empty($check1)){ ?>
	                                        			<h4 class="text-danger">REGISTRADO</h4>
	                                        		<?php }else{ ?>
	                                        			<h4>NO REGISTRADO</h4>	                                        			
	                                        		<?php } ?>
	                                        	</td>
		                                    </tr>
	                                    	<?php $count = $count + 1;
	                                    	} ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
	            	</div>
	            	<?php } ?>
	            	<div class="col-md-12">
	            		<hr>
	            		<input type="hidden" name="search_item" value="<?php echo $model['item']; ?>" required>
	            		<button type="submit" name="btnReg" class="btn btn-block btn-danger"><i class="fa fa-edit"></i> Registrar</button>
	            	</div>
            	</form>
            </div>
        </div>
    </div> <!-- end col -->
</div>	
</div>
<script type="text/javascript">
	function verificateDependent(iden){
		if(document.getElementById("cbox"+iden).checked == true){
			document.getElementById("dep_doc"+iden).required = true;
			document.getElementById("dep_phone"+iden).required = true;
		}else{
			document.getElementById("dep_doc"+iden).required = false;
			document.getElementById("dep_phone"+iden).required = false;

		}
	}
</script>