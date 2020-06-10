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
if ($_SESSION['productos']==1)
{	
require_once "../modelos/Productos.php";

$producto=new Inscripcion();

$idproducto=isset($_POST["idproducto"])? limpiarCadena($_POST["idproducto"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$idmaterial=isset($_POST["idmaterial"])? limpiarCadena($_POST["idmaterial"]):"";
$medidas=isset($_POST["medidas"])? limpiarCadena($_POST["medidas"]):"";
$color=isset($_POST["color"])? limpiarCadena($_POST["color"]):"";
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
		move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/productos/" . $imagen);
		}
		}
		if (empty($idproducto)){

		$rspta=$producto->insertar($nombre,$idcategoria,$idmaterial,$medidas,$color,$imagen);
		
		echo $rspta ? "PRODUCTO REGISTRADO CORRECTAMENTE" : "EL PRODUCTO NO SE PUDO REGISTRAR DE FORMA CORRECTA";
		}
		
		else {
			$rspta=$producto->editar($idproducto,$idcategoria,$idmaterial,$nombre,$medidas,$color,$imagen);
			echo $rspta ? "PRODUCTO ACTUALIZADO CORRECTAMENTE" : "EL PRODUCTO NO SE PUDO ACTUALIZAR DE FORMA CORRECTA";
		}
	break;

	case 'desactivar':
		$rspta=$producto->desactivar($idproducto);
 		echo $rspta ? "PRODUCTO DESACTICADO" : "EL PRODUCTO NO SE PUDO DESACTIVAR";
	break;	

	case 'activar':
		$rspta=$producto->activar($idproducto);
 		echo $rspta ? "PRODUCTO ACTIVADO" : "EL PRODUCTO NO SE PUEDE ACTIVAR";
	break;

	case 'mostrar':
		$rspta=$producto->mostrar($idproducto);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$producto->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idproducto.')">
 				<i class="fa fa-pencil"></i></button>'.


 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idproducto.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idproducto.')"><i class="fa fa-pencil"></i></button>'.

 					' <button class="btn btn-primary" onclick="activar('.$reg->idproducto.')"><i class="fa fa-check"></i></button>',


 			
 				"1"=>$reg->nombre,
 				"2"=>$reg->categoria,
 				"3"=>$reg->materiales,
 			
 				"4"=>$reg->medidas,
 			
 				"5"=>"<img src='../files/productos/".$reg->imagen."' height='50px' width='50px' >",
 				"6"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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
}
else
{
  require 'noacceso.php';
}
}
ob_end_flush();





?>