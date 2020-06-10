<?php 
require_once "../modelos/Consultas.php";

$consulta=new Consultas();


switch ($_GET["op"]){
	//case 'comprasfecha':
		////$fecha_inicio=$_REQUEST["fecha_inicio"];
		//$fecha_fin=$_REQUEST["fecha_fin"];

		//$rspta=$consulta->comprasfecha($fecha_inicio,$fecha_fin);
 		//Vamos a declarar un array
 		//$data= Array();

 		//while ($reg=$rspta->fetch_object()){
 		////	$data[]=array(
 			////	"0"=>$reg->fecha,
 			////	"1"=>$reg->usuario,
 			//	//"2"=>$reg->proveedor,
 			//	"3"=>$reg->tipo_comprobante,
 				//"4"=>$reg->serie_comprobante.' '.$reg->num_comprobante,
 				//"5"=>$reg->total_compra,
 				//"6"=>$reg->impuesto,
 				//"7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
 				//'<span class="label bg-red">Anulado</span>'
 				//);
 		//}
 		//$results = array(
 		//	"sEcho"=>1, //Información para el datatables
 		//	"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 		//	"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 		//	"aaData"=>$data);
 		//echo json_encode($results);

	//break;


	case 'fechagrado':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];
		$idgrado=$_REQUEST["idgrado"];
		

		$rspta=$consulta->fechagrado($fecha_inicio,$fecha_fin,$idgrado);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->fecha,
 			
 				"1"=>$reg->alumnos,
 				
 				"2"=>$reg->nombre_grado,
 				//"3"=>$reg->tipo_comprobante,
 				//"4"=>$reg->serie_comprobante.' '.$reg->num_comprobante,
 				//"5"=>$reg->total_venta,
 				//"6"=>$reg->impuesto,
 				"3"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;




	case 'selectCliente':
		require_once "../modelos/Grado.php";
		$grado = new Grado();

		$rspta = $grado->listarG();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idgrado . '>' . $reg->nombre_grado . '</option>';
				}
	break;
}
?>