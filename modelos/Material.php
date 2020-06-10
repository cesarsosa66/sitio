<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Material
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre_material)
	{
		$sql="INSERT INTO materiales (nombre_material,condicion)
		VALUES ('$nombre_material', '1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idmaterial,$nombre_material)
	{
		$sql="UPDATE materiales SET nombre_material='$nombre_material' WHERE idmaterial='$idmaterial'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idmaterial)
	{
		$sql="UPDATE materiales SET condicion='0' WHERE idmaterial='$idmaterial'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idmaterial)
	{
		$sql="UPDATE materiales SET condicion='1' WHERE idmaterial='$idmaterial'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmaterial)
	{
		$sql="SELECT * FROM materiales WHERE idmaterial='$idmaterial'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql= "SELECT * FROM materiales";
		return ejecutarConsulta($sql);
		
		//$sql="SELECT g.idproducto,g.nombre,g.medidas,g.color,g.condicion, c.ano as ciclolectivo FROM productos g INNER join ciclolectivo c ON g.idciclolectivo = c.idciclolectivo";
		//return ejecutarConsulta($sql);		
	}

	public function select($idgrado)
	{
$sql="SELECT * FROM grado  WHERE condicion=1 ";
return ejecutarConsulta($sql);
	}
	

	public function selectmaterial()
	{
$sql="SELECT * FROM materiales  WHERE condicion=1 ";
return ejecutarConsulta($sql);
	}

		public function listarG()
	{
		$sql="SELECT * FROM grado ";
		return ejecutarConsulta($sql);		
	}


}

?>