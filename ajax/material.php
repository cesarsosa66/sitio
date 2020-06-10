<?php 
//ob_start();
//if (strlen(session_id()) < 1){
	//session_start();//Validamos si existe o no la sesión
//}
//if (!isset($_SESSION["nombre"]))
//{
 // header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
//}
//else
//{
//Validamos el acceso solo al usuario logueado y autorizado.
//if ($_SESSION['material']==1)
//{	
require_once "../modelos/Material.php";

$mat=new Material();

$idmaterial=isset($_POST["idmaterial"])? limpiarCadena($_POST["idmaterial"]):"";

$nombre_material=isset($_POST["nombre_material"])? limpiarCadena($_POST["nombre_material"]):"";

//$seccion=isset($_POST["seccion"])? limpiarCadena($_POST["seccion"]):"";
//$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
//$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		//if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		//{
			//$imagen=$_POST["imagenactual"];
		//}
		//else 
		//{
			//$ext = explode(".", $_FILES["imagen"]["name"]);
			//if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			//{
				//$imagen = round(microtime(true)) . '.' . end($ext);
				//move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/" . $imagen);
			//}
		//}
		if (empty($idmaterial)){
			$rspta=$mat->insertar($nombre_material);
			echo $rspta ? "MATERIAL REGISTRADO CORRECTAMENTE" : "EL METERIAL NO SE PUDO REGISTRAR CORRECTAMENTE";
		}
		else {
			$rspta=$mat->editar($idmaterial,$nombre_material);
			echo $rspta ? "MATERIAL ACTUALIZADO CORRECTAMENTE" : "EL MATERIAL NO SE PUDO ACTUALIZAR";
		}
	break;

	case 'desactivar':
		$rspta=$mat->desactivar($idmaterial);
 		echo $rspta ? "MATERIAL DESACTIVADO" : "EL MATERIAL NO SE PUDO DESACTIVAR";
	break;

	case 'activar':
		$rspta=$mat->activar($idmaterial);
 		echo $rspta ? "MATERIAL ACTIVADO" : "EL MATERIAL NO SE PUDO ACTIVAR";
	break;

	case 'mostrar':
		$rspta=$mat->mostrar($idmaterial);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$mat->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idmaterial.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idmaterial.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idmaterial.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idmaterial.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre_material,
 				
 				//"5"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >",
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

	case "selectmaterial":
		require_once "../modelos/Material.php";
		$material = new Material();

		$rspta = $material->selectmaterial();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idmaterial . '>' . $reg->nombre_material . '</option>';
				}
	break;


	

	
}


?>