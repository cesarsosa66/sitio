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
if ($_SESSION['tutores']==1) {

  

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
                          <h1 class="box-title">Tutores <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>  <a href="../reportes/reportetutores.php" target="_blank"><button class="btn btn-info"><i class="fa fa-clipboard"></i> Reporte</button></a>    </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre Completo</th>
                            <th>DNI</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Dirección</th>
                            <th>Telefono</th>
                            <th>Localidad</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            
                          </thead>
                          <tbody>  

                          </tbody>
                       
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Nombres(*):</label>
                            <input type="hidden" name="idtutor" id="idtutor">

                            <input type="text" class="form-control" name="nombre_tutor" id="nombre_tutor" maxlength="100" placeholder="Nombre Completo" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo de documento(*):</label>
                            <select class="form-control select-picker" name="tipo_documento" id="tipo_documento" required>
                              <option value="DNI">DNI</option>
                              
                              
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Número de documento(*)</label>
                           <input type="text" class="form-control" name="dni" id="dni" maxlength="256" placeholder="Número de Documento"   required >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha de nacimiento(*):</label>
                            <input type="date" class="form-control" name="fecha_de_nacimiento" id="fecha_de_nacimiento" maxlength="256" placeholder="Fecha de Nacimiento"   required >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Domicilio(*):</label>
                            <input type="text" class="form-control" name="domicilio" id="domicilio" maxlength="256" placeholder="Domicilio"  required>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Telefono(*):</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="256" placeholder="Telefono"  required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12"   >
                            <label>Provincia(*):</label>
                            <select id="idprovincia" name="idprovincia" class="form-control selectpicker" data-live-search="true"  required >

                              <?php
                              require "../config/Conexion.php";
                              $mysql= new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
                               $consulta = "SELECT id,provincia FROM provincia";
                               $result = mysqli_query($mysql,$consulta);

                                while ($reg=mysqli_fetch_array($result))
                                  {
                                   echo "<option value=\"$reg[id]\">$reg[provincia]</option>";                  
                                    }

                              ?>
                            </select>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Localidad(*):</label>
                             <select name="localidad" id="localidadx" class="form-control is-valid" class="select_form" placeholder="Ingrese su Localidad" selected='selected'  required>
                           <option value="0">Seleccione</option>
                           </select>

                          </div>





                          
                        <!-- <h4>Datos del tutor----------------------------------------------------</h4>


                           <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Nombre completo:</label>
                            <input type="text" class="form-control" name="" id="" maxlength="256" placeholder="Nombre completo">
                          </div>


                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Domicilio:</label>
                            <input type="text" class="form-control" name="" id="" maxlength="256" placeholder="Número de documento">
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo de documento:</label>
                            <select class="form-control select-picker" name="tipo_documento" id="tipo_documento" required>
                              <option value="DNI">DNI</option>
                              <option value="RUC">RUC</option>
                              <option value="CEDULA">CEDULA</option>
                            </select>
                          </div>

                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Numero de documento:</label>
                            <input type="text" class="form-control" name="" id="" maxlength="256" placeholder="Número de documento">
                          </div>


                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12"   >
                            <label>Provincia:</label>
                            <select id="idprovincia" name="idprovincia" class="form-control selectpicker" data-live-search="true" >

                              <?php
                              //require "../config/Conexion.php";
                             // $mysql= new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
                              
                              //// $consulta = "SELECT id,provincia FROM provincia";
                               //$result = mysqli_query($mysql,$consulta);

                                //while ($reg=mysqli_fetch_array($result))
                                  {
                                 //  echo "<option value=\"$reg[id]\">$reg[provincia]</option>";                  
                                    }

                              ?>
                            </select>
                          </div>

 
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Localidad:</label>
                             <select name="localidad" id="localidadx" class="form-control is-valid" class="select_form" placeholder="Ingrese su Localidad" selected='selected'>
                           <option value="0">Seleccione</option>
                           </select>

                          </div>

-->

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Email(*):</label>
                            <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Email"  required>
                          </div>



<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
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
<script type="text/javascript" src="scripts/tutor.js"> </script>


 <script language="JavaScript" type="text/JavaScript">
            $(document).ready(function(){
                $("#idprovincia").change(function(event){
                    var id = $("#idprovincia").find(':selected').val();
                    $("#localidadx").load('carga_localidad.php?id='+id);
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