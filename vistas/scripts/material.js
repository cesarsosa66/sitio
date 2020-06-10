var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	
	//$("#imagenmuestra").hide();
	//$('#mAlmacen').addClass("treeview active");
    //$('#lArticulos').addClass("active");
}

//Función limpiar
function limpiar()
{
	//$("#codigo").val("");
	$("#nombre_grado").val("");
	$("#turno").val("");
	$("#seccion").val("");
	$("#idciclolectivo").attr("src","");
	$("#imagenactual").val("");
	$("#print").hide();
	$("#idgrado").val("");
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
		            
		        ],
		"ajax":
				{
					url: '../ajax/material.php?op=listar',
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
		url: "../ajax/material.php?op=guardaryeditar",
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

function mostrar(idmaterial)
{
	$.post("../ajax/material.php?op=mostrar",{idmaterial : idmaterial}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);
       $("#nombre_material").val(data.nombre_material);
	   $("#idmaterial").val(data.idmaterial);
 		

 	})
}

//Función para desactivar registros
function desactivar(idmaterial)
{
	bootbox.confirm("¿ESTA SEGURO DE DESACTIVAR EL MATERIAL?", function(result){
		if(result)
        {
        	$.post("../ajax/material.php?op=desactivar", {idmaterial : idmaterial}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idmaterial)
{
	bootbox.confirm("¿ESTA SEGURO DE ACTIVAR EL MATERIAL?", function(result){
		if(result)
        {
        	$.post("../ajax/material.php?op=activar", {idmaterial : idmaterial}, function(e){
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