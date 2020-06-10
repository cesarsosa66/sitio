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
if ($_SESSION['consultasa']==1) {
  

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
                          <h1 class="box-title">Observaciones <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            
                            <th>Grado</th>
                            <th>Nombre</th>
                            <th>Dni</th>
                            <th>Fecha de Observación</th>
                            <th>Observación</th>

                            <th>Estado</th>
                            
                          </thead>
                          <tbody>  

                          </tbody>
                       
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Grado(*):</label>
                             <input type="hidden" name="idgrado_alumno" id="idgrado_alumno">
                            <select id="idgrado" name="idgrado"  class="form-control selectpicker" data-live-search="true"    >
                              
                               <?php
                             // require "../config/Conexion.php";
                              //$mysql= new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
                              // $consulta = "SELECT idgrado,nombre_grado FROM grado";
                               //$result = mysqli_query($mysql,$consulta);

                                //while ($reg=mysqli_fetch_array($result))
                                //  {



                                  // echo "<option value=\"$reg[idgrado]\">$reg[nombre_grado]</option>";                  
                                   // }

                              ?>
                              






                            </select>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Nombre del Alumno(*):</label>
                           <select id="idalumno" name="idalumno" class="form-control is-valid" class="form-control selectpicker"  selected='selected'   required="">
                           </select>
                          </div>

                         

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha de Observación:</label>
                            <input type="date" class="form-control" name="fecha_ob" id="fecha_ob" maxlength="256" placeholder="Fecha de Observacion">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label>Descripción:</label>
                            <textarea name="descripcion" id="descripcion" rows="5" cols="70" placeholder="Escribe aqui tus comentarios." maxlength="256"    ></textarea>
                          </div>





                          
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
<script type="text/javascript" src="scripts/situacionalumno.js"></script>

<script type="text/javascript">
  
   

  $(document).ready(function(){
                $("#idgrado").change(function(event){
                    var id = $("#idgrado").find(':selected').val();
                    $("#idalumno").load('cargaalumnoins.php?id='+id);
                });
            });

</script>
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