<?php 
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
if (!isset($_SESSION["nombre"]))
{
  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
}
else
{
//Validamos el acceso solo al usuario logueado y autorizado.
if ($_SESSION['documentacion']==1)
{	
require_once "../modelos/Documentacion.php";

$doc=new Documentacion();

$idimagen=isset($_POST["idimagen"])? limpiarCadena($_POST["idimagen"]):"";
$idgrado=isset($_POST["idgrado"])? limpiarCadena($_POST["idgrado"]):"";
$idalumno=isset($_POST["idalumno"])? limpiarCadena($_POST["idalumno"]):"";
$fecha_pre=isset($_POST["fecha_pre"])? limpiarCadena($_POST["fecha_pre"]):"";
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
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/legajoalumnos/" . $imagen);
			}
		}
		if (empty($idimagen)){
			$rspta=$doc->insertar($idgrado,$idalumno,$fecha_pre,$imagen);
			echo $rspta ? "Imagen insertada correctamente" : "La Imagen no pudo ser registrada";
		}
		else {
			$rspta=$doc->editar($idimagen,$idgrado,$idalumno,$fecha_pre,$imagen);
			echo $rspta ? "La Imagen fue actualizada correctamente" : "La Imagen no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$doc->desactivar($idimagen);
 		echo $rspta ? "Imagen Eliminada" : "Imagen no se pudo eliminar";
	break;

	case 'activar':
		$rspta=$doc->activar($idimagen);
 		echo $rspta ? "Imagen activada" : "Imagen no se puede activar";
	break;

	case 'mostrar':
		$rspta=$doc->mostrar($idimagen);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$doc->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idimagen.')">
 				<i class="fa fa-pencil"></i></button>'.


 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idimagen.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idimagen.')"><i class="fa fa-pencil"></i></button>'.

 					' <button class="btn btn-primary" onclick="activar('.$reg->idimagen.')"><i class="fa fa-check"></i></button>',


 				"1"=>$reg->nombre_grado,
 				"2"=>$reg->nombre,
 				"3"=>$reg->dni,
 				"4"=>$reg->fecha_pre,
 				
 				
 				"5"=>"<img src='../files/legajoalumnos/".$reg->imagen."' height='50px' width='50px' >",
 				"6"=>($reg->condicion)?'<span class="label bg-green">Imagen Activada</span>':
 				'<span class="label bg-red"> Imagen Eliminada</span>'
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
}
else
{
  require 'noacceso.php';
}
}
ob_end_flush();





?>