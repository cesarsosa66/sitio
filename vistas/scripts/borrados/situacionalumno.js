var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	//Cargamos los items al select categoria
	//$.post("../ajax/grado.php?op=selectCategoria", function(r){
	       //     $("#idciclolectivo").html(r);
	       //     $('#idciclolectivo').selectpicker('refresh');

	//});


		//Cargamos los items al select grado
	$.post("../ajax/grado.php?op=selectgrado", function(r){
	            $("#idgrado").html(r);
	            $('#idgrado').selectpicker('refresh');

	});


	


	//$("#imagenmuestra").hide();
	//$('#mAlmacen').addClass("treeview active");
    //$('#lArticulos').addClass("active");
}



//Función limpiar
function limpiar()
{
	//$("#codigo").val("");
	$("#idalumno").val("");
	$("#idgrado").val("");
	$("#turno").val("");
	$("#seccion").val("");
	$("#idciclolectivo").attr("src","");
	$("#fecha_inscripcion").val("");
		$("#descripcion").val("");

	//$("#print").hide();
	
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();

	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/situacionalumno.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"language": {
            "lengthMenu": "Mostrar : _MENU_ registros",
            "buttons": {
            "copyTitle": "Tabla Copiada",
            "copySuccess": {
                    _: '%d líneas copiadas',
                    1: '1 línea copiada'
                }
            }
        },
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/situacionalumno.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idgrado_alumno)
{
	$.post("../ajax/situacionalumno.php?op=mostrar",{idgrado_alumno : idgrado_alumno}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);



$("#idgrado").val(data.idgrado);
$('#idgrado').selectpicker('refresh');

$("#idalumno").val(data.idalumno);




		
		
		$("#fecha_ob").val(data.fecha_ob);
		$("#descripcion").val(data.observaciones);
$("#idgrado_alumno").val(data.idgrado_alumno);

	
	  // $("#idalumno option[value="+ data.idalumno +"]").attr("selected",true);
	
	
 		
 		//generarbarcode();

 	})
}

//Función para desactivar registros
function desactivar(idgrado_alumno)
{
	bootbox.confirm("¿Está Seguro de eliminar  la observación de el alumno?", function(result){
		if(result)
        {
        	$.post("../ajax/situacionalumno.php?op=desactivar", {idgrado_alumno : idgrado_alumno}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idgrado_alumno)
{
	bootbox.confirm("¿Está Seguro de asignar la observación de  el Alumno?", function(result){
		if(result)
        {
        	$.post("../ajax/situacionalumno.php?op=activar", {idgrado_alumno : idgrado_alumno}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//función para generar el código de barras
//function generarbarcode()
//{
	//codigo=$("#codigo").val();
	//JsBarcode("#barcode", codigo);
	//$("#print").show();
//}

//Función para imprimir el Código de barras
function imprimir()
{
	$("#print").printArea();
}

init();