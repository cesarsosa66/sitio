<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Tutor
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}
public  function ValidarTutor($dni)
	{
		$sql = "SELECT count(*) inscripto FROM tutor where dni = '$dni'  ";
		return ejecutarConsulta($sql);
	}
	//Implementamos un método para insertar registros
	public function insertar($nombre,$tipo_documento,$dni,$fecha_de_nacimiento,$domicilio,$id,$telefono,$imagen)
	{
		$sql="INSERT INTO tutor (nombre_tutor,tipo_documento,dni,fecha_de_nacimiento,domicilio,id,telefono,imagen,condicion)
		VALUES ('$nombre','$tipo_documento'  , '$dni' ,  '$fecha_de_nacimiento' , '$domicilio'  , '$id' , '$telefono' ,   '$imagen', '1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idtutor,$nombre,$domicilio,$id,$telefono,$imagen)
	{
		$sql="UPDATE tutor SET nombre_tutor='$nombre',domicilio='$domicilio'  ,id='$id' ,telefono='$telefono' ,imagen='$imagen' WHERE idtutor='$idtutor'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idtutor)
	{
		$sql="UPDATE tutor SET condicion='0' WHERE idtutor='$idtutor'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idtutor)
	{
		$sql="UPDATE tutor SET condicion='1' WHERE idtutor='$idtutor'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idtutor)
	{
		$sql="SELECT * FROM tutor WHERE idtutor='$idtutor'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		//$sql="SELECT * FROM tutor";
		//return ejecutarConsulta($sql);		

$sql="SELECT  t.idtutor,t.nombre_tutor,t.dni,t.domicilio,t.fecha_de_nacimiento,t.telefono,t.condicion,t.imagen, l.localidad as localidades FROM tutor t INNER join localidades l ON t.id = l.id";

	return ejecutarConsulta($sql);
	}


	public function select()
	{
    $sql="SELECT * FROM tutor  WHERE condicion=1";
    return ejecutarConsulta($sql);
	}
    }

?>