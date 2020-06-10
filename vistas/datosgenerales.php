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
if ($_SESSION['datos generales']==1) {
  


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
                          <h1 class="box-title">Datos Generales del sitio web <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive " id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Acciones</th>
                          <th>Telefono</th>
                          <th>Correo</th>
                          <th>Direccion</th>
                          <th>Logo</th>
                              <th>Estado</th>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                        
                    </div>
                    <div class="panel-body" id="formularioregistros">

                      <form name="formulario" id="formulario" method="POST">
<div class="form-group col-lg-6  col-md-6 col-sm-6 col-xs-12">
  <label>Telefono:</label>
  <input type="hidden" name="iddatos" id="iddatos">
<input type="text" class="form-control" name="telefono" id="telefono" maxlength="50" placeholder="Telefono" required >


</div>

<div class="form-group col-lg-6  col-md-6 col-sm-6 col-xs-12">
  <label>Correo:</label>

<input type="text" class="form-control" name="correo" id="correo" maxlength="256" placeholder="Correo Electronico">


</div>

<div class="form-group col-lg-6  col-md-6 col-sm-6 col-xs-12">
  <label>Direccion:</label>

<input type="text" class="form-control" name="direccion" id="direccion" maxlength="256" placeholder="Direccion">


</div>
<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Logo:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" style="width: 300px" id="imagenmuestra">
                          </div>

<div class="form-group col-lg-6  col-md-6 col-sm-6 col-xs-12 ">
<button class="btn btn-primary" type="submit" id="btnGuardar"> <i class="fa fa-save">Guardar</i>
  
</button>

<button class="btn btn-danger" onclick="cancelarform()" type="button" > <i class="fa fa-arrow-circle-left">Cancelar</i>
  
</button>
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
<script src="scripts/datosgenerales.js"></script>
<?php
}
ob_end_flush();
?>