<?php 

require "send_email.php";
require "../config/Conexion.php";
$mysqli= new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
ob_start();
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$email = $mysqli->escape_string($_POST['email']);

	$result = $mysqli->query("SELECT * FROM usuario WHERE email = '$email'");

	if($result->num_rows === 0){
		$_SESSION['message'] = "El usuario con ese correo no fue encontrado!";
		header('Location: error.php');
		exit();
	}else{
		$user = $result->fetch_assoc();

		$email = $user['email'];
		//$hash  = $user['hash'];
		$nombre = $user['nombre'];

		$_SESSION['message'] = 'Por favor revisa tu correo <strong>'.$email.'</strong>'
		. ' por un link de confirmación para completar el cambio de contraseña!';

		$para_usuario = $email;
		$subject = 'Solicitud de cambio de password ';
		$message_body = '
		Hola '.$nombre.',
		<br/>Has solicitado un cambio de contraseña!
		Por favor hacer click en el link para cambiar tu contraseña

		http://localhost/sistema/Codigofuente/sistema/vistas/reset.php?email='.$email;

		sendEmail($para_usuario, $subject, $message_body);
		header('Location: success.php');
		exit();
	}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Recupera tu contraseña</title>
	<?php include 'css.html'; ?>
</head>
<body>

	<div class="form">
		
		<h1>Ingresa tu correo para restablecer tu contraseña.</h1>

		<form action="clave.php" method = "post">
			<div>
             <input class="form-control" type="email" placeholder= "Ingresa tu correo" required autocomplete="off" name="email"/>			
			</div>
			<br/>
			<button class="button button-block"/>Enviar</button>
		</form>

	</div>
	
</body>
</html>