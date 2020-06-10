var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
}

//Función limpiar
function limpiar()
{
	$("#nombre_tutor").val("");
	$("#dni").val("");
	$("#domicilio").val("");
	$("#telefono").val("");
	$("#id").val("");
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
		"aProcessing": true,//Activamos el procesamiento del datatablesS
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/tutor.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
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
		url: "../ajax/tutor.php?op=guardaryeditar",
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

function mostrar(idtutor)
{
	$.post("../ajax/tutor.php?op=mostrar",{idtutor : idtutor}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre_tutor").val(data.nombre_tutor);
		$("#dni").val(data.dni);
		$("#domicilio").val(data.domicilio);
		$("#telefono").val(data.telefono);
		$("#id").val(data.id);
 		$("#idtutor").val(data.idtutor);
 		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/tutores/"+data.imagen);
		$("#imagenactual").val(data.imagen);

 	})
}

//Función para desactivar registros
function desactivar(idtutor)
{
	bootbox.confirm("¿Está Seguro de desactivar el Tutor?", function(result){
		if(result)
        {
        	$.post("../ajax/tutor.php?op=desactivar", {idtutor : idtutor}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idtutor)
{
	bootbox.confirm("¿Está Seguro de activar el Ciclo lectivo?", function(result){
		if(result)
        {
        	$.post("../ajax/tutor.php?op=activar", {idtutor : idtutor}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();