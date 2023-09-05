<?php
class ApiPoa{

	public function GetIndicators($item){
		$data = Yii::app()->dbpoa->createCommand("SELECT
				OBJ_NOMBRE
			FROM
				KPIS
			WHERE
				ITEM = '$item'
			GROUP BY
				OBJ_NOMBRE
			ORDER BY
				OBJ_NOMBRE")->queryAll();

		$detail = array();

		$total = 0;

		if(!empty($data)){

			foreach($data as $value){
				
				$obj = $value['OBJ_NOMBRE'];

				$post = Yii::app()->dbpoa->createCommand("SELECT
					ELE_ID,
					KPI_NOMBRE,
					OBJ_NOMBRE
				FROM
					KPIS
				WHERE
					ITEM = '$item'
				AND OBJ_NOMBRE = '$obj'
				GROUP BY
					ELE_ID,
					KPI_NOMBRE,
					OBJ_NOMBRE
				ORDER BY
					KPI_NOMBRE")->queryAll();

				$objetivo['objetivo'] = $obj;

				$indicadores['indicadores'] = $post;

				$detail[] = $objetivo + $indicadores;

				$total = $total + 1 + count($post);
			}
		}

		$cantidad['cantidad'] = $total;

		$cadena['cadena'] = $detail;

		$union = array_merge($cantidad,$cadena);

		$send = $union;

        return $send;
	}

	public function GetReportKpi($item,$kpi){
		$data = Yii::app()->dbpoa->createCommand("SELECT
				*
			FROM
				KPIS
			WHERE
				ITEM = '$item'
			AND ELE_ID = '$kpi'
			ORDER BY
				PERIODO")->queryAll();

		$send = $data;

        return $send;
	}

	public function UpdateKpiReport($result){

		$item = $result['item'];

		$resultado = $result['resultado'];

		$explorar = explode('_', $result['identificador']);

		$mod_id = $explorar[0];

		$ele_id = $explorar[1];

		$ser_id = $explorar[2];

		$per_id = $explorar[3];

		$data = Yii::app()->dbpoa->createCommand("SELECT
				*
			FROM
				ELEMENTO_VALOR
			WHERE
				MOD_ID = '$mod_id'
			AND ELE_ID = '$ele_id'
			AND SER_ID = '$ser_id'
			AND PER_ID = '$per_id'")->queryRow();

		if(!empty($data)){
			try{
	            $post = Yii::app()->dbpoa->createCommand("UPDATE 
	                	ELEMENTO_VALOR
	                SET EVA_VALOR = '$resultado'
	                WHERE
							MOD_ID = '$mod_id'
						AND ELE_ID = '$ele_id'
						AND SER_ID = '$ser_id'
						AND PER_ID = '$per_id'")->execute();

	            $send = array('status'=>0,'message'=>'Registro Actualizado!');

	        }catch (Exception $e){

	            $send = array('status'=>2,'message'=>'No se pudo actualizar los valores ingresados.');

	        }
			
		}else{
			$send = array('status'=>1,'message'=>'No existe Elemento Valor con los Datos: '.$result['identificador']);
		}
		return $send;
	}
}
?>