<?php 
require "../config/Conexion.php";
$mysqli= new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
session_start();


if(isset($_GET['email']) && !empty($_GET['email'])){
   $email =  $mysqli->escape_string($_GET['email']); 
  // $hash = $mysqli->escape_string($_GET['hash']); 

   $result = $mysqli->query("SELECT * FROM usuario WHERE email= '$email' ");

   if($result->num_rows == 0){
   		$_SESSION['message'] = "Has ingresado a una URL invalida para cambiar contraseña!";
        header("location: error.php");
        exit();
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cambiar Contraseña</title>
	<?php include 'css.html'; ?>
</head>
<body>
	<div class="form">
		<h1>Ingresa tu nueva contraseña</h1>
		 <form action="reset_password.php" method="post">
              
	          <div class="field-wrap">
	            <input type="password" class="form-control" name="nuevopassword" placeholder = "Nueva contraseña" required/>
	          </div>
	          <br/>    
	          <div class="field-wrap">
	            <input type="password" class="form-control" name="confirmarpassword" placeholder = "Confirmar tu nueva contraseña" required/>
	          </div>
	          
	           
	             <input type="hidden" name="email" value="<?= $email ?>">    
	              
	          <button class="button button-block"/>Actualizar</button>
          
          </form>

	</div>
	
</body>
</html>