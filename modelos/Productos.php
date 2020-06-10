<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Inscripcion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	public  function ValidarInscripcion($idalumno,$idciclolectivo)
	{
		$sql = "SELECT count(*) inscripto FROM inscripcion where idalumno = '$idalumno' AND idciclolectivo = '$idciclolectivo' ";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para insertar registros
	public function insertar($nombre,$idcategoria,$idmaterial,$medidas,$color,$imagen)
	{
		$sql="INSERT INTO productos (nombre,idcategoria,idmaterial,medidas,color,imagen,condicion)
		VALUES (  '$nombre' ,'$idcategoria'  , '$idmaterial', '$medidas',  '$color' ,'$imagen' , '1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idproducto,$idcategoria,$idmaterial,$nombre,$medidas,$color,$imagen)
	{
		$sql="UPDATE productos SET idcategoria='$idcategoria',idmaterial='$idmaterial',nombre='$nombre'   ,medidas='$medidas'  ,color='$color' ,imagen='$imagen'  WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idproducto)
	{
		$sql="UPDATE productos SET condicion='0' WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idproducto)
	{
		$sql="UPDATE productos SET condicion='1' WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idproducto)
	{
		$sql="SELECT * FROM productos WHERE idproducto='$idproducto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{

	$sql="SELECT p.idproducto,p.nombre,p.medidas,p.imagen,p.condicion,c.nombre as categoria,m.nombre_material as materiales FROM productos p , categorias c, materiales m WHERE p.idcategoria=c.idcategoria AND p.idmaterial=m.idmaterial"  ;
		return ejecutarConsulta($sql);		
		
	}




	public function select()
	{
$sql="SELECT * FROM categorias  WHERE condicion=1";
return ejecutarConsulta($sql);
	}

}

?>