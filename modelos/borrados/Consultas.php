<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Consultas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	

	public function fechagrado($fecha_inicio,$fecha_fin,$idgrado)
	{
		
$sql="SELECT i.idinscripcion,i.fecha_inscripcion as fecha , a.idalumno, a.nombre as alumnos , i.condicion, g.nombre_grado FROM  grado g , inscripcion i INNER JOIN alumnos a ON i.idalumno=a.idalumno WHERE i.fecha_inscripcion >='$fecha_inicio' AND i.fecha_inscripcion<='$fecha_fin' and i.idgrado=g.idgrado                  and i.idgrado='$idgrado' " ;
	return ejecutarConsulta($sql);		
	}

}

?>