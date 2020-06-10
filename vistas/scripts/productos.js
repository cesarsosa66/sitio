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
	$.post("../ajax/catego.php?op=selectcategoria", function(r){
	            $("#idcategoria").html(r);
	            $('#idcategoria').selectpicker('refresh');

	});


	//Cargamos los items al select alumno
	$.post("../ajax/material.php?op=selectmaterial", function(r){
	            $("#idmaterial").html(r);
	            $('#idmaterial').selectpicker('refresh');

	});

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
	$("#idcategoria").val("");
	$("#idmaterial").val("");
	$("#nombre").val("");
	$("#color").val("");
	$("#medidas").attr("src","");
	$("#imagen").val("");
		$("#idproducto").val("");

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
					url: '../ajax/productos.php?op=listar',
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
		url: "../ajax/productos.php?op=guardaryeditar",
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

function mostrar(idproducto)
{
	$.post("../ajax/productos.php?op=mostrar",{idproducto : idproducto}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);



		$("#idcategoria").val(data.idcategoria);
		$('#idcategoria').selectpicker('refresh');

        $("#idmaterial").val(data.idmaterial);
		$('#idmaterial').selectpicker('refresh');

        
		$("#nombre").val(data.nombre);
		$("#color").val(data.color);
		$("#medidas").val(data.medidas);
		
		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/productos/"+data.imagen);
		$("#imagenactual").val(data.imagen);
 	
 		$("#idproducto").val(data.idproducto);

 		//generarbarcode();

 	})
}

//Función para desactivar registros
function desactivar(idproducto)
{
	bootbox.confirm("¿ESTA SEGURO DE DESACTIVAR EL PRODUCTO?", function(result){
		if(result)
        {
        	$.post("../ajax/productos.php?op=desactivar", {idproducto : idproducto}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idproducto)
{
	bootbox.confirm("¿ESTA SEGURO DE ACTIVAR EL PRODUCTO?", function(result){
		if(result)
        {
        	$.post("../ajax/productos.php?op=activar", {idproducto : idproducto}, function(e){
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