<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Documentacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idgrado,$idalumno,$fecha_pre,$imagen)
	{
		$sql="INSERT INTO tbl_image (idgrado,idalumno,fecha_pre,imagen,condicion)
		VALUES (  '$idgrado' , '$idalumno','$fecha_pre', '$imagen' , '1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idimagen,$idgrado,$idalumno,$fecha_pre,$imagen)
	{
		$sql="UPDATE tbl_image SET idgrado='$idgrado', idalumno='$idalumno',fecha_pre='$fecha_pre',imagen='$imagen' WHERE idimagen='$idimagen'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idimagen)
	{
		$sql="UPDATE tbl_image  SET condicion='0' WHERE idimagen='$idimagen'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idimagen)
	{
		$sql="UPDATE tbl_image  SET condicion='1' WHERE idimagen='$idimagen'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idimagen)
	{
		$sql="SELECT a.idalumno,a.nombre,i.fecha_pre,i.imagen,i.idimagen from tbl_image i , alumnos a where i.idimagen = a.idalumno and idimagen='$idimagen'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
$sql=  " SELECT  d.nombre_grado,a.nombre,a.dni,g.fecha_pre ,g.imagen, g.condicion, g.idimagen FROM grado d , tbl_image  g , alumnos a where g.idgrado=d.idgrado and g.idalumno=a.idalumno and g.idimagen=g.idimagen ";
		return ejecutarConsulta($sql);		
		
			
	}


public function select($idgrado)
	{
$sql="SELECT a.nombre ,i.idalumno FROM  grado g , inscripcion i inner join alumnos a  on i.idalumno=a.idalumno   and i.idgrado='$idgrado'";
return ejecutarConsulta($sql);
	}


}

?>