<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Datos
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}
//public  function ValidarCiclo($ano)
	//{
		//$sql = "SELECT count(*) inscripto FROM ciclolectivo where ano = '$ano'  ";
		//return ejecutarConsulta($sql);
	//}
	//Implementamos un método para insertar registros
	public function insertar($telefono,$correo,$direccion,$imagen)
	{
		$sql="INSERT INTO datosgenerales (telefono,correo,direccion,imagen)
		VALUES ('$telefono','$correo','$direccion' ,'$imagen')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($iddatos,$telefono,$correo,$direccion,$imagen)
	{
		$sql="UPDATE datosgenerales SET telefono='$telefono',correo='$correo',  direccion='$direccion' , imagen='$imagen' WHERE iddatos='$iddatos'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($iddatos)
	{
		$sql="UPDATE datosgenerales SET condicion='0' WHERE iddatos='$iddatos'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($iddatos)
	{
		$sql="UPDATE datosgenerales SET condicion='1' WHERE iddatos='$iddatos'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($iddatos)
	{
		$sql="SELECT * FROM datosgenerales ";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM datosgenerales";
		return ejecutarConsulta($sql);		
	}
	public function select()
	{
$sql="SELECT * FROM ciclolectivo  WHERE condicion=1";
return ejecutarConsulta($sql);
	}
}

?>