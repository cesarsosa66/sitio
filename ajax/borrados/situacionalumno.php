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
if ($_SESSION['consultasa']==1)
{	
require_once "../modelos/Situacionalumno.php";

$situacion=new Situacion();

$idgrado_alumno=isset($_POST["idgrado_alumno"])? limpiarCadena($_POST["idgrado_alumno"]):"";
$idgrado=isset($_POST["idgrado"])? limpiarCadena($_POST["idgrado"]):"";
$idalumno=isset($_POST["idalumno"])? limpiarCadena($_POST["idalumno"]):"";
$fecha_ob=isset($_POST["fecha_ob"])? limpiarCadena($_POST["fecha_ob"]):"";
$observaciones=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";


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
		if (empty($idgrado_alumno)){
			$rspta=$situacion->insertar($idgrado,$idalumno,$fecha_ob,$observaciones);
			echo $rspta ? "Observación insertada correctamente" : "La Observación no pudo ser registrada";
		}
		else {
			$rspta=$situacion->editar($idgrado_alumno,$idgrado,$idalumno,$fecha_ob,$observaciones);
			echo $rspta ? "La Observación fue actualizada correctamente" : "La Observación no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$situacion->desactivar($idgrado_alumno);
 		echo $rspta ? "Observación Eliminada" : "Observación no se pudo eliminar";
	break;

	case 'activar':
		$rspta=$situacion->activar($idgrado_alumno);
 		echo $rspta ? "Observación activada" : "Observación no se puede activar";
	break;

	case 'mostrar':
		$rspta=$situacion->mostrar($idgrado_alumno);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$situacion->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idgrado_alumno.')">
 				<i class="fa fa-pencil"></i></button>'.


 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idgrado_alumno.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idgrado_alumno.')"><i class="fa fa-pencil"></i></button>'.

 					' <button class="btn btn-primary" onclick="activar('.$reg->idgrado_alumno.')"><i class="fa fa-check"></i></button>',

                
 				"1"=>$reg->nombre_grado,
 				"2"=>$reg->nombre,
 				"3"=>$reg->dni,
 				"4"=>$reg->fecha_ob,
 				"5"=>$reg->observaciones,
 				
 				//"5"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >",
 				"6"=>($reg->condicion)?'<span class="label bg-green">Observación Activada</span>':
 				'<span class="label bg-red"> Observación Eliminada</span>'
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