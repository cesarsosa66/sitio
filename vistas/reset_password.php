<?php

require "../config/Conexion.php";
$mysqli= new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if($_POST['nuevopassword'] === $_POST['confirmarpassword']){
		$nuevo_password = ($_POST['nuevopassword']);
		$email = $mysqli->escape_string($_POST['email']);

		//$nuevo_password=hash("SHA256",$nuevo_password);
        //hash("SHA256",$nuevo_password);
		$sql = "UPDATE usuario SET clave='$nuevo_password' WHERE email='$email'";
        echo $sql;
		if($mysqli->query($sql)){
			$_SESSION['message'] = "Tu contraseña ha sido actualizada!";
            header("location: success.php");    
            
            exit(); 
		}
	}else{
		 $_SESSION['message'] = "Las dos contraseñas que ingresaste no coinciden!";
		    header("location: error.php"); 
            exit();  
	}
}


?>