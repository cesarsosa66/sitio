<?php
if (strlen(session_id()) < 1 ) {
  session_start();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Rodriguez Aberturas</title>

     
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
    <script src="../sweetalert2/sweetalert2.all.js"></script>
    

  </head>
  <body class="hold-transition skin-yellow-light sidebar-mini">
    <div >

      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo" >
          <!-- mini logo for sidebar mini 50x50 pixels -->
         
           <!--<img src="../public/img/logo1.jpg" align="left" width="auto" height="50">-->
          <!-- logo for regular state and mobile devices -->
          <span class="logo-xl"><p>R.Aberturas </p></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu" >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/usuarios/<?php  echo $_SESSION['imagen']; ?>" class="user-image"  alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" alt="User Image">
                    <p>
                      
                      
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar Sesion</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>

            <?php
if ($_SESSION['datos generales']==1) {
  echo '<li>
              <a href="datosgenerales.php">
                <i class="fa fa-home"></i> <span>Inicio</span>
              </a>
            </li>    ';
  
}

            ?>

                    
           
            

                      <?php
                  if ($_SESSION['categorias']==1) {
  echo ' <li class="treeview">
              <a href="catego.php">
                <i class="fa fa-plus"></i>
                <span>Categorias</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              
            </li>';
  
}
 ?>




                      <?php
if ($_SESSION['material']==1) {
  echo ' <li class="treeview">
              <a href="material.php">
                <i class="fa fa-angle-left"></i>
                <span>Tipo de materiales</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              
            </li>';
  
}
 ?>









                      <?php
if ($_SESSION['productos']==1) {
echo ' <li class="treeview">
      <a href="productos.php">
               <i class="fa fa-plus"></i>
                <span>Productos</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              
            </li>';
  
}
 ?>



                      <?php
//if ($_SESSION['inscripcion']==1) {
 // echo ' <li class="treeview">
             ////// <a href="inscripcion.php">
                ////<i class="fa fa-user"></i>
                ////<span>Inscripciones</span>
                //// <i class="fa fa-angle-left pull-right"></i>
              ////</a>
              
            ////</li>';
  
//}
 ?>







                      <?php
if ($_SESSION['acceso']==1) {
  echo '
            <li class="treeview">
              <a href="#">
                <i class="fa fa-lock"></i> <span> Acceso de Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
                
              </ul>
            </li>
';
  

  }

 ?>
      







                           <?php
//////if ($_SESSION['documentacion']==1) {
  ////echo '
          
            //<li class="treeview">
             ////// <a href="documentacion.php">
               //// <i class="fa fa-folder"></i> <span>Documentación Alumno </span>
               // <i class="fa fa-angle-left pull-right"></i>
              ////</a>
             
            //</li>
////';
  

  //}

 ?>



                      <?php
//if ($_SESSION['consultaa']==1) {
 // echo '
           //// <li class="treeview">
           //   <a href="fechagrado.php">
            ////////    <i class="fa fa-bar-chart"></i> <span>Consulta de Alumnos</span>
             //////   <i class="fa fa-angle-left pull-right"></i>
             //// </a>
                      //   </li>
////////';
  

  //////}

 ?>
      

                      <?php
////if ($_SESSION['consultasa']==1) {
 // echo '
          //////////
           //////// <li class="treeview">
            //////  <a href="situacionalumno.php">
             ////   <i class="fa fa-bar-chart"></i> <span>Situación del Alumno </span>
             //   <i class="fa fa-angle-left pull-right"></i>
             //// </a>
            //// 
           // </li>
//';
  

 // }

 ?>
     



















            <li >
              <a href="ayuda.php">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
              
              </a>
            </li>
          
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
