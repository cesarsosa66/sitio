<?php 
require_once "../modelos/Datosgenerales.php";

$anolec=new Datos();

$iddatos=isset($_POST["iddatos"])? limpiarCadena($_POST["iddatos"]):"";

$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
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
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/logo/" . $imagen);
            }
        }

	if (empty($iddatos)){



				$rspta=$anolec->insertar($telefono,$correo,$direccion,$imagen);
				

				echo $rspta ? "LOS DATOS SE REGISTRARON DE MANERA CORRECTA" : "LOS DATOS NO SE PUDIERON REGISTRAR DE MANERA CORRECTA";
			}
			

		else {
			$rspta=$anolec->editar($iddatos,$telefono,$correo,$direccion,$imagen);
			echo $rspta ? "LOS DATOS FUERON ACTUALIZADOS DE MANERA CORRECTA" : "LOS DATOS NO SE PUDIERON ACTUALIZAR DE MANERA CORRECTA";
		}
	break;

	case 'desactivar':
		$rspta=$anolec->desactivar($iddatos);
 		echo $rspta ? "DATOS DESACTIVADOS" : "LOS DATOS NO SE PUEDEN DESACTIVAR";
 		break;
	break;

	case 'activar':
		$rspta=$anolec->activar($iddatos);
 		echo $rspta ? "DATOS ACTIVADOS" : "LOS DATOS NO SE PUEDEN ACTIVAR";
 		break;
	break;

	case 'mostrar':
		$rspta=$anolec->mostrar($iddatos);
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
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->iddatos.')"><i class="fa fa-eye"></i></button>'.

 					' <button class="btn btn-danger" onclick="desactivar('.$reg->iddatos.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->iddatos.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->iddatos.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->telefono,
 				"2"=>$reg->correo,
 				"3"=>$reg->direccion,
 				"4"=>"<img src='../files/logo/".$reg->imagen."' height='50px' width='50px' >",
 				"5"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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