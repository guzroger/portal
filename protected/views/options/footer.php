<?php 
$usuario = Yii::app()->user->um->loadUserById(Yii::app()->user->id);

$item = Yii::app()->user->um->getFieldValue($usuario,'item');

$apo = new ApiApo;

$teletrabajo = $apo->TeleTrabajo($item);
?>

<?php if(!empty($teletrabajo)){ ?>
<div class="modal fade" id="teletrabajoModal" tabindex="-1" role="dialog" aria-labelledby="teletrabajoModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-lg" role="document">
 	  	<div class="modal-content">
 	  	  	<div class="modal-header">
 	  	  	  	<h5 class="modal-title" id="teletrabajoModalLabel">Salas de Teletrabajo</h5>
 	  	  	  	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 	  	  	    	<span aria-hidden="true">&times;</span>
 	  	  	  	</button>
 	  	  	</div>
 	  	  	<div class="modal-body">
 	  	  		<div class="row">
 	  	  	 	<?php foreach($teletrabajo as $trab){ 

 	  	  	 		$id = $trab['team_id'];
 	  	  	 		?>
 	  	  	 		<div class="col-md-9 my-2" align="left">
 	  	  	 			<h5>Sala: <?php echo $trab['team_name']; ?></h5>
 	  	  	 		</div>
 	  	  	 		<div class="col-md-3">
 	  	  	 			<a href="<?php echo $trab['team_url']; ?>" target="_blank" class="btn btn-block btn-danger" onclick="starWorkOnline('<?php echo $id; ?>')">Ingresar</a>
 	  	  	 		</div>
 	  	  	 		<div class="col-md-12">
 	  	  	 			<hr>
 	  	  	 		</div>
 	  	  	 	<?php } ?>
 	  	  	 	</div>
 	  	  	</div>
 	  	</div>
 	</div>
</div>
<?php } ?>
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <?php echo date('Y'); ?> © COMTECO R.L. - DESIGN BY DEV TI 
        </div>
    </div>
</div>
<script type="text/javascript">

function starWorkOnline(sala){

    jQuery('.loader_div').show();

    $.ajax({
        type: 'post',
        url: "<?php echo Yii::app()->createUrl('site/ajaxStarOnline'); ?>",
        data: {'sala' : sala},
        dataType: 'json',
        success: function (output) {
            //EJECUTADO CON EXITO
            jQuery('.loader_div').hide();

            $('#teletrabajoModal').modal('hide');
        }
    });
}	
</script>