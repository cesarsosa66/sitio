<?php

require "../config/Conexion.php";
$mysql= new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$consulta = "SELECT a.nombre , a.idalumno from inscripcion i inner join alumnos a on i.idalumno=a.idalumno WHERE idgrado = ".$_GET['id'];
$result = mysqli_query($mysql,$consulta);
echo $consulta;

while ($fila = mysqli_fetch_array($result)) {
 	
    echo '<option value="'.$fila['idalumno'].'">'.$fila['nombre'].'</option>';	
}

?>
