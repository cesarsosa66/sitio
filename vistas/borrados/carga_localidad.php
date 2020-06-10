
<?php

require "../config/Conexion.php";
$mysql= new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$consulta = "SELECT * from localidades WHERE id_select = ".$_GET['id'];
$result = mysqli_query($mysql,$consulta);
echo $consulta;

while ($fila = mysqli_fetch_array($result)) {
 	
    echo '<option value="'.$fila['id'].'">'.$fila['localidad'].'</option>';	
}

?>
