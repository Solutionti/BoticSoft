		$(document).ready(function(){
			load(1);
			
		});

		function load(page){
			var q= $("#q").val();
                        var q2= $("#q2").val();
                        var q3= $("#q3").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_compras.php?action=ajax&page='+page+'&q='+q+'&q2='+q2+'&q3='+q3,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					$('[data-toggle="tooltip"]').tooltip({html:true}); 
					
				}
			})
		}

	
		
			function eliminar (id)
		{
			var q= $("#q").val();
		if (confirm("Realmente deseas eliminar la compra")){	
		$.ajax({
        type: "GET",
        url: "./ajax/buscar_compras.php",
        data: "id="+id,"q":q,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});
		}
		}
		
		function imprimir_factura(id_factura){
			VentanaCentrada('./pdf/documentos/ver_factura1.php?id_factura='+id_factura,'Factura','','1024','768','true');
		}
