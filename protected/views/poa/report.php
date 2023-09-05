<div class="row">
    <div class="col-lg-12 col-xl-12">
        <div class="">
            <div class="card-box">
                <h4 class="card-title">Reportar KPI</h4>
                <div class="row">
                    <div class="col-md-3">
                    	<div class="card-box">
                    		<h4>Indicadores</h4>
                        	<?php if(!empty($model['indicators'])){ ?>
	                        	<form id="kpiCheckInd" action="<?php echo Yii::app()->createUrl('poa/ajaxKpiReport'); ?>" method="POST">

	                        		<?php if($model['indicators']['cantidad'] < 10){ ?>
	                        			<br>
	                        			<?php 
	                        			foreach ($model['indicators']['cadena'] as $value) { ?>
	                        			<h4 class="text-danger"><?php echo $value['objetivo']; ?></h4>
	                        			<br>
	                        				<?php foreach($value['indicadores'] as $indicator){ 
		                                		if(isset($_GET['kpi'])){

		                                			$cc = $_GET['kpi'];

		                                			if($cc == $indicator['ELE_ID']){
		                                				$check = 'checked';
		                                			}else{
		                                				$check = '';
		                                			}
		                                		}else{
		                                			$check = '';
		                                		}
		                                		?>
			                                	<div class="col-md-12">
				                                    <div class="custom-control custom-radio">
			                                            <input type="radio" class="custom-control-input" name="indicator_kpi" id="customSwitch<?php echo $indicator['ELE_ID']; ?>" value="<?php echo $indicator['ELE_ID']; ?>" <?php echo $check; ?> onclick="validateIndicator();">
			                                            <label class="custom-control-label" for="customSwitch<?php echo $indicator['ELE_ID']; ?>"><?php echo $indicator['KPI_NOMBRE']; ?></label>
			                                        </div>
			                                		<hr>
			                                	</div>
	                                		<?php } ?>
	                                	<?php } ?>
	                        		<?php }else{ ?>
		                        		<div id="wrapper">
				                            <div class="row scrollbar" id="style-2">
		                                		<br>
			                                	<?php 
			                                	foreach ($model['indicators']['cadena']  as$value) { ?>
				                        			<h4 class="text-danger"><?php echo $value['objetivo']; ?></h4>
				                        			<br>
				                                	<?php foreach($value['indicadores'] as $indicator){ 

				                                		if(isset($_GET['kpi'])){

				                                			$cc = $_GET['kpi'];

				                                			if($cc == $indicator['ELE_ID']){
				                                				$check = 'checked';
				                                			}else{
				                                				$check = '';
				                                			}
				                                		}else{
				                                			$check = '';
				                                		}
				                                		?>
					                                	<div class="col-md-12">
						                                    <div class="custom-control custom-radio">
					                                            <input type="radio" class="custom-control-input" name="indicator_kpi" id="customSwitch<?php echo $indicator['ELE_ID']; ?>" value="<?php echo $indicator['ELE_ID']; ?>" <?php echo $check; ?> onclick="validateIndicator();">
					                                            <label class="custom-control-label" for="customSwitch<?php echo $indicator['ELE_ID']; ?>"><?php echo $indicator['KPI_NOMBRE']; ?></label>
					                                        </div>
					                                		<hr>
					                                	</div>
				                                	<?php } ?>
			                                	<?php } ?>
			                                </div>
			                            </div>
	                        		<?php } ?>			                        
	                            </form>
                            <?php }else{ ?>
                            	<div class="col-md-12">
                            		<h5>Usted no tiene indicadores asignados</h5>
                            	</div>
                            <?php } ?>
                    	</div>
                    </div>
                    <div class="col-md-9">
                    	<div class="card-box">
                    		<h4>Detalle</h4>
                            <?php if(!empty($model['detail'])){ ?>
                            	<h5>Indicador <?php echo $model['detail'][0]['KPI_NOMBRE']; ?></h5>
                            	<table id="tablereportkpi" class="table table-striped table-bordered">
                            		<thead>
		                                <tr>
		                                	<th></th>
		                                    <th>Periodo</th>
		                                    <th>Elemento</th>
		                                    <th>Nombre</th>
		                                    <th>Valor</th>
		                                    <th>Estado</th>
		                                    <th>Acciones</th>
		                                </tr>
		                            </thead> 
		                            <tbody>
		                            	<?php foreach($model['detail'] as $detail){ 
		                            		$code = $detail['MOD_ID'].'_'.$detail['ELE_ID'].'_'.$detail['SER_ID'].'_'.$detail['PER_ID'];
		                            		?>
			                            	<tr>
			                                    <td><?php echo $detail['PERIODO']; ?></td>
			                                    <td><?php echo $detail['PERIODO']; ?></td>
			                                    <td><?php echo $detail['ELE_ID']; ?></td>
			                                    <td><?php echo $detail['KPI_NOMBRE']; ?></td>
			                                    <td>
			                                    	<label id="lab<?php echo $code; ?>"><?php echo $detail['VALOR']; ?></label>
			                                    	<?php if($detail['ESTADO'] == 0){ ?>
			                                    		<input type="hidden" id="<?php echo $code; ?>" class="form-control" placeholder="<?php echo $detail['VALOR']; ?>" name="valueKpi">
			                                    	<?php } ?>
		                                    	</td>
			                                    <td><?php echo $detail['VALOR_NOMBRE']; ?></td>
			                                    <td align="center">
			                                    <?php if($detail['ESTADO'] == 0){ ?>			                                    	
			                                    	<button id="edit<?php echo $code; ?>" type="button" class="btn btn-danger btn-rounded" onclick="editKpi('<?php echo $code; ?>');"><i class="fa fa-edit"></i></button>
			                                    	<button id="save<?php echo $code; ?>" type="button" class="btn btn-success btn-rounded" style="display:none;" onclick="saveKpi('<?php echo $code; ?>');"><i class="fa fa-save"></i></button>
			                                    	<button id="cancel<?php echo $code; ?>" type="button" class="btn btn-warning btn-rounded" style="display:none;" onclick="cancelKpi('<?php echo $code; ?>');"><i class="fa fa-times"></i></button>
		                                    	<?php } ?>
			                                    </td>
			                                </tr>
	                            		<?php } ?>
		                            </tbody>
                            		<tfoot>
		                                <tr>
		                                	<th></th>
		                                    <th>Periodo</th>
		                                    <th>Elemento</th>
		                                    <th>Nombre</th>
		                                    <th>Valor</th>
		                                    <th>Estado</th>
		                                    <th>Acciones</th>
		                                </tr>
		                            </tfoot> 
                            	</table>            
                            <?php }else{ ?>
                            	<div class="col-md-12">
                            		<h5>No existen resultados, realice una busqueda por algun tipo de indicador.</h5>
                            	</div>
                            <?php } ?>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

    //Buttons examples
    var table = $('#tablereportkpi').DataTable({
        scrollY:        "450px",
        scrollCollapse: true,
        paging:         false,
        /*buttons: [
            { extend: 'copy', text: 'Copiar',exportOptions: {columns: ":visible"} }, 
            { extend: 'excel', text: 'Excel',exportOptions: {columns: ":visible"} }, 
            { extend: 'pdf', text: 'PDF',exportOptions: {columns: ":visible"} }
        ],*/
        order: [[ 0, "asc" ]],
        columnDefs: [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
        ],                                
        language: {
            "sLengthMenu": "Mostrar _MENU_ Resultados",
            "zeroRecords": "No se encontraron resultados",
            "info": "_START_ al _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 - 0 de 0",
            "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
                "sLast": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                "sNext": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-right'></i></button>",
                "sPrevious": "<button class='btn btn-info btn-circle btn-sm'><i class='fa fa-arrow-circle-left'></i></button>",
            },
            "sProcessing": "Procesando...",
        }
    });
    table.buttons().container().appendTo('#tablereportkpi_wrapper .col-md-6:eq(0)');
});

function validateIndicator(){
	jQuery('.loader_div').show();

	document.getElementById("kpiCheckInd").submit();
}

function editKpi(valor){
	document.getElementById(valor).setAttribute("type", "text");
	document.getElementById("lab" + valor).style.display = "none";
	document.getElementById("edit" + valor).style.display = "none";
	document.getElementById("save" + valor).style.display = "block";
	document.getElementById("cancel" + valor).style.display = "block";
}

function saveKpi(valor){

	resultado = document.getElementById(valor).value;

	if (resultado == null){
		swal({
		  	title: "Advertencia",
		  	text: "El campo valor no puede ser nulo",
		  	type: "warning"
		});
	}else{

		swal({
			title: "¿Esta seguro de actualizar el KPI?",
			text: "Si usted esta de acuerdo presionar en Aceptar, caso contrario en Cancelar.",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#D62917",
			cancelButtonColor: "#AAB3B3",
			confirmButtonText: "Aceptar!",
			cancelButtonText: "Cancelar"
	    }).then(
	    function(isConfirm) {
	 		if (isConfirm) {
	 			jQuery('.loader_div').show();
	    		
	    		identificador = valor;

	    		$.ajax({
		        type: 'post',
		        url: "<?php echo Yii::app()->createUrl('poa/ajaxUpKpiReport'); ?>",
		        data: {'resultado' : resultado,'identificador' : identificador},
		        dataType: 'json',
		        success: function (output) {

		            	if(output.sts == 0){
		            		jQuery('.loader_div').hide();
	            			swal({
							  	title: "Exito!",
							  	text: output.msg,
							  	type: "success"
							}).then(
	    					function(isConfirm) {
	    						jQuery('.loader_div').show();
	    						location.reload();
	    					});
	            		}else{
	            			jQuery('.loader_div').hide();
	            			swal({
							  	title: "Ocurrio un Problema!",
							  	text: "Por Favor Intentelo nuevamente. Detalle: " + output.msg,
							  	type: "error"
							});
	            		}
	        		}
	    		});
	  		} 
		});
	}
  
}

function cancelKpi(valor){
	document.getElementById(valor).setAttribute("type", "hidden");
	document.getElementById("lab" + valor).style.display = "block";
	document.getElementById("edit" + valor).style.display = "block";
	document.getElementById("save" + valor).style.display = "none";
	document.getElementById("cancel" + valor).style.display = "none";
}
</script>