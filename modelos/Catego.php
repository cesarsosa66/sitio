<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Catego
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}
public  function validarcategoria($nombre)
	{
		$sql = "SELECT count(*) inscripto FROM categorias where nombre = '$nombre'  ";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="INSERT INTO categorias (nombre,condicion)
		VALUES ('$nombre','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcategoria,$nombre)
	{
		$sql="UPDATE categorias SET nombre='$nombre' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idcategoria)
	{
		$sql="UPDATE categorias SET condicion='0' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idcategoria)
	{
		$sql="UPDATE categorias SET condicion='1' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcategoria)
	{
		$sql="SELECT * FROM categorias WHERE idcategoria='$idcategoria'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM categorias";
		return ejecutarConsulta($sql);		
	}
	public function select()
	{
$sql="SELECT * FROM categorias  WHERE condicion=1";
return ejecutarConsulta($sql);
	}
}

?>