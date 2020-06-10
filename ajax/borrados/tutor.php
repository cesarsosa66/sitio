<?php 
require_once "../modelos/Tutor.php";

$tutor=new Tutor();

$idtutor=isset($_POST["idtutor"])? limpiarCadena($_POST["idtutor"]):"";
$nombre=isset($_POST["nombre_tutor"])? limpiarCadena($_POST["nombre_tutor"]):"";
$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$dni=isset($_POST["dni"])? limpiarCadena($_POST["dni"]):"";
$fecha_de_nacimiento=isset($_POST["fecha_de_nacimiento"])? limpiarCadena($_POST["fecha_de_nacimiento"]):"";
$domicilio=isset($_POST["domicilio"])? limpiarCadena($_POST["domicilio"]):"";
$id=isset($_POST["localidad"])? limpiarCadena($_POST["localidad"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':



	if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/tutores/" . $imagen);
			}
		}


		

if (empty($idtutor)){
			$vble = $tutor->ValidarTutor($dni);
			$cant = 10;	
			while ($reg = $vble->fetch_object())
			{
				$cant = $reg->inscripto;
			}
			if ($cant == 0) {
				# code...
				$rspta=$tutor->insertar($nombre,$tipo_documento,$dni,$fecha_de_nacimiento,$domicilio,$id,$telefono,$imagen);
				echo $rspta ? " - Tutor registrado correctamente" : "El Tutor no pudo registrar";
			}
			else
			{
				echo "Error - El Tutor ya se encuentra registrado en la Base de datos-";

			}

		}


		else {
			$rspta=$tutor->editar($idtutor,$nombre,$domicilio,$id,$telefono,$imagen);
			echo $rspta ? "Los datos del tutor se actualizaron correctamente" : "Los datos del tutor NO se pudieron registrar";
		}
	break;

	case 'desactivar':
		$rspta=$tutor->desactivar($idtutor);
 		echo $rspta ? "El tutor esta Desactivado" : "El tutor no se pudo desactivar";
 		break;
	break;

	case 'activar':
		$rspta=$tutor->activar($idtutor);
 		echo $rspta ? "Tutor Activado" : "El tutor no se pudo activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$tutor->mostrar($idtutor);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$tutor->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idtutor.')"><i class="fa fa-pencil"></i></button>'. 
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idtutor.')"><i class="fa fa-close"></i></button>': 
 					
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idtutor.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idtutor.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre_tutor,
 				"2"=>$reg->dni,
 				"3"=>$reg->fecha_de_nacimiento,
 				"4"=>$reg->domicilio,
 				"5"=>$reg->telefono,
 				"6"=>$reg->localidades,
 				"7"=>"<img src='../files/tutores/".$reg->imagen."' height='50px' width='50px' >",
 				"8"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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
}
?>