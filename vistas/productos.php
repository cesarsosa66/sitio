<?php
//acticamos el almacenamiento del bufer
ob_start();
session_start();
 if (!isset($_SESSION["nombre"])) {
   header("Location: login.html");
 }
else
{


require 'header.php';
if ($_SESSION['productos']==1) {
  

?>
<!--Contenido-->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Productos <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                           
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Tipo de material</th>
                            <th>Medidas</th>
                            <th>Imagen</th>
                            
                            <th>Estado</th>
                            
                          </thead>
                          <tbody>  

                          </tbody>
                       
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <label>Nombre de el producto:</label>
  <input type="hidden" name="idproducto" id="idproducto">
  <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required >
</div>



                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Categoria(*):</label>
                            

                          <select id="idcategoria" name="idcategoria" class="form-control selectpicker" data-live-search="true"  required ></select>
                          </div>


                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo de material(*):</label>
                            <select id="idmaterial" name="idmaterial" class="form-control selectpicker" data-live-search="true"  required ></select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Medidas(*):</label>
                            <input type="text" class="form-control" name="medidas" id="medidas" maxlength="50" placeholder="Medidas" required >
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Color(*):</label>
                            <input type="text" class="form-control" name="color" id="color" maxlength="50" placeholder="Color" required >
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" style="width: 300px" id="imagenmuestra">
                          </div>

                      <div class="form-group col-lg-6  col-md-6 col-sm-6 col-xs-12 ">

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->


<?php
}

else {
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/productos.js"> </script>

 <!--
<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">

<thead>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Turno</th>
                            <th>Seccion</th>
                            <th>Ciclo Lectivo</th>
                            
                          </thead>
                          <tbody>   
<?php

  //include "../config/Conexion.php";
 //$con = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
  //$tabla1 = "SELECT * FROM grado";
  //$result = mysqli_query($con,$tabla1);
  
 //while ($res = mysqli_fetch_array($result)) {
   //echo "<td>".$res["nombre_grado"]."</td>";

                                                   
                          
         
?> 
</tbody>              
</table>-->
<?php
}
ob_end_flush();
?>