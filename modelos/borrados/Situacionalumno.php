<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Situacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idgrado,$idalumno,$fecha_ob,$observaciones)
	{
		$sql="INSERT INTO grado_alumno (idgrado,idalumno,fecha_ob,observaciones,condicion)
		VALUES (  '$idgrado' , '$idalumno','$fecha_ob', '$observaciones' , '1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idgrado_alumno,$idgrado,$idalumno,$fecha_ob,$observaciones)
	{
		$sql="UPDATE grado_alumno SET idgrado='$idgrado', idalumno='$idalumno',fecha_ob='$fecha_ob',observaciones='$observaciones' WHERE idgrado_alumno='$idgrado_alumno'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idgrado_alumno)
	{
		$sql="UPDATE grado_alumno SET condicion='0' WHERE idgrado_alumno='$idgrado_alumno'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idgrado_alumno)
	{
		$sql="UPDATE grado_alumno SET condicion='1' WHERE idgrado_alumno='$idgrado_alumno'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idgrado_alumno)
	{
		$sql="SELECT alumnos.idalumno,alumnos.nombre,grado_alumno.fecha_ob,grado_alumno.observaciones,grado_alumno.idgrado,grado_alumno.idalumno,grado_alumno.idgrado_alumno FROM grado_alumno , alumnos WHERE 
         grado_alumno.idalumno=alumnos.idalumno and 
		idgrado_alumno='$idgrado_alumno'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
$sql=  " SELECT  d.nombre_grado,a.nombre,a.dni,g.fecha_ob ,g.observaciones, g.condicion, g.idgrado_alumno FROM grado d , grado_alumno g , alumnos a  where g.idgrado=d.idgrado and g.idalumno=a.idalumno and g.idgrado_alumno=g.idgrado_alumno ";
		return ejecutarConsulta($sql);		
		
			
	}


public function select($idgrado)
	{
$sql="SELECT a.nombre ,i.idalumno FROM  grado g , inscripcion i inner join alumnos a  on i.idalumno=a.idalumno   and i.idgrado='$idgrado'";
return ejecutarConsulta($sql);
	}


}

?>