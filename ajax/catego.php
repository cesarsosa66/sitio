<?php 
require_once "../modelos/Catego.php";

$anolec=new Catego();

$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcategoria)){
			$vble = $anolec->validarcategoria($nombre);
			$cant = 10;	
			while ($reg = $vble->fetch_object())
			{
				$cant = $reg->inscripto;
			}
			if ($cant == 0) {
				# code...
				$rspta=$anolec->insertar($nombre);
				echo $rspta ? " CATEGORIA REGISTRADA CORRECTAMENTE" : "LA CATEGORIA NO SE PUDO REGISTRAR";
			}
			else
			{
				echo "ERROR- LA CATEGORIA YA EXISTE EN LA BASE DE DATOS";

			}

		}
		else {
			$rspta=$anolec->editar($idcategoria,$nombre);
			echo $rspta ? "CATEGORIA ACTUALIZADA CORRECTAMENTE" : "LA CATEGORIA NO SE PUDO ACTUALIZAR";
		}
	break;

	case 'desactivar':
		$rspta=$anolec->desactivar($idcategoria);
 		echo $rspta ? "CATEGORIA DESACTIVADA" : "LA CATEGORIA NO SE PUEDE DESACTIVAR";
 		break;
	break;

	case 'activar':
		$rspta=$anolec->activar($idcategoria);
 		echo $rspta ? "CATEGORIA ACTIVADA" : "LA CATEGORIA NO SE PUEDE ACTIVAR";
 		break;
	break;

	case 'mostrar':
		$rspta=$anolec->mostrar($idcategoria);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$anolec->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-eye"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcategoria.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcategoria.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 		
 				"2"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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


	case "selectcategoria":
		require_once "../modelos/Productos.php";
		$alumno = new Inscripcion();

		$rspta = $alumno->select(); 

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
				}
	break;
}
?>