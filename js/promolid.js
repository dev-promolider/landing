function cestado(){
	var pais = $("#pais").val();
	if(pais.length>0){
		var parametros = {
			"id" : pais
		};

		$.ajax({
			data : parametros,
			type : "post",
			url : "../ajax/estados.php",
			beforeSend:function(){
				cargando();
			},
			success:function(response){

				$("#estados").html(response);
				nocargando();
			}
		});
	}
}

function buscarusuario(){
	var busqueda = $("#busqueda").val();
	var parametros = {
		"busq" : busqueda
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/buscarusuarios.php",
		success:function(response){
			$("#listausuarios").html(response);
		}
	});
}

function cafiliacion(){
	var af = $("#afiliacion").val();
	if(af.length>0){
		var parametros = {
			"af" : af
		};

		$.ajax({
			data : parametros,
			type : "post",
			url : "../ajax/afiliaciones.php",
			beforeSend:function(){
				cargando();
			},
			success:function(response){
				$("#afiliaciones").html(response);
				nocargando();
			}
		});
	}

	if(af!="" && af!="1"){
		metododepago();
	}else{
		$("#metodopago").html('');
	}

}
function metododepago(){
	$.ajax({
		url : "../ajax/metodos.php",
		beforeSend:function(){
			cargando();
		},
		success:function(response){
			$("#metodopago").html(response);
			nocargando();
		}
	});
}

function cargando(){
	$("#ajax-loader").html("<img src='../img/ajax-loader.gif'/>");
}
function nocargando(){
	$("#ajax-loader").html("");
}

function verpago(idp){
	var parametros = {
		"idp" : idp
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/verpago.php",
		beforeSend:function(){
			$("#ajax-loader").html("<img src='../img/ajax-loader.gif'/>");
		},
		success:function(response){
			$("#cajafixed").fadeIn();
			$("#xcajafixed").fadeIn();
			$("#bgf").fadeIn();
			$("#cajafixed").html("<span id=\"xcajafixed\" onclick=\"$('#cajafixed').fadeOut();$('#bgf').fadeOut();\">X</span>"+response);
		}
	});

}

function ver_user_arbol(nvirtual){
	var parametros = {
		"nvirtual" : nvirtual
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/ver_user_arbol.php",
		beforeSend:function(){
			$("#ajax-loader").html("<img src='img/ajax-loader.gif'/>");
		},
		success:function(response){
			$("#ajax-loader").html('');
			$("#cajafixed").fadeIn();
			$("#xcajafixed").fadeIn();
			$("#bgf").fadeIn();
			$("#cajafixed").html("<span id=\"xcajafixed\" onclick=\"$('#cajafixed').fadeOut();$('#bgf').fadeOut();\">X</span>"+response);
		}
	});
}

function cargarmasmensajes(){
	$.ajax({
		url : "ajax/cargar.php",
		beforeSend:function(){
			$("#mm").html("<center style='padding:5px;'><i class='fa fa-refresh fa-spin'></i></center>");
		},
		success:function(response){
			$("#mm").html('<table class="table table-mailbox"><tr><th align="center"><center style="cursor:pointer;" onclick="cargarmasmensajes();"><span>+</span> <small>Mostrar Mas</small></center></th></tr></table>');
			$("#mostrarmsjs").html($("#mostrarmsjs").html()+""+response);
		}
	});
}

function cargarmasmensajes2(){
	$.ajax({
		url : "ajax/cargar2.php",
		beforeSend:function(){
			$("#mm").html("<center style='padding:5px;'><i class='fa fa-refresh fa-spin'></i></center>");
		},
		success:function(response){
			$("#mm").html('<table class="table table-mailbox"><tr><th align="center"><center style="cursor:pointer;" onclick="cargarmasmensajes2();"><span>+</span> <small>Mostrar Mas</small></center></th></tr></table>');
			$("#mostrarmsjs").html($("#mostrarmsjs").html()+""+response);
		}
	});
}

function aggcar(idp){
	//var cant = prompt("¿Cantidad a cargar en el carrito?");

	//if(cant==""){
		//cant = 1;
	//}

	cant = 1;

	var parametros = {
		"idp" : idp,
		"cant" : cant
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/agregar.php",
		beforeSend:function(){
			$("#ajax-loader").html("<img src='img/ajax-loader.gif'/>");
		},
		success:function(response){
			$("#ajax-loader").html("");
			$("#msjtienda").html(response);
			cargarcarrito();
			if($("#cuerpo_carro_compra").css("display") == "none"){
				opcar();
			}
		}
	});
}
cargarcarrito();

function cargarcarrito(){
	$.ajax({
		url : "ajax/carrito.php",
		beforeSend:function(){
			$("#ajax-loader").html("<center><img src='img/ajax-loader.gif'/></center>");
		},
		success:function(response){
			$("#ajax-loader").html("");
			$("#cuerpo_carro_compra").html(response);
		}
	});
}

function opcar(){
	if($("#cuerpo_carro_compra").css("display")=="none"){
		$("#barra_carro_compra").css("bottom","293px");
		$("#cuerpo_carro_compra").css("display","block");
		$("#boton_compra").css("display","block");
	}else{
		$("#barra_carro_compra").css("bottom","0px");
		$("#cuerpo_carro_compra").css("display","none");

		$("#boton_compra").css("display","none");
	}
}

function quitar(idp){
	var parametros = {
		"idp" : idp
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/quitar_carrito.php",
		beforeSend:function(){
			$("#ajax-loader").html("<img src='img/ajax-loader.gif'/>");
		},
		success:function(){
			$("#ajax-loader").html("");
			cargarcarrito();
		}
	});
}


function agregar_carrito(idp){
	var parametros = {
		"idp" : idp
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/agregar_carrito.php",
		beforeSend:function(){
			$("#ajax-loader").html("<img src='img/ajax-loader.gif'/>");
		},
		success:function(response){
			$("#ajax-loader").html("");
			cargarcarrito();
		}
	});
}


function restar_carrito(idp){
	var parametros = {
		"idp" : idp
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/restar_carrito.php",
		beforeSend:function(){
			$("#ajax-loader").html("<img src='img/ajax-loader.gif'/>");
		},
		success:function(response){
			$("#ajax-loader").html("");
			cargarcarrito();
		}
	});
}












function bandeja_entrada(){
	$.ajax({
		url : "ajax/bandeja_entrada.php",
		beforeSend:function(){
			$("#ajax-loader").html("<img src='img/ajax-loader.gif'/>");
		},
		success:function(response){
			actualizar_no_leidos();
			$("#ajax-loader").html("");
			$("#rerecici").attr("class","active");
			$("#enenvivi").attr("class","");
			$("#botonsisimo").attr("onclick","cargarmasmensajes();");
			$("#mm").html('<table class="table table-mailbox"><tr><th align="center"><center style="cursor:pointer;" onclick="cargarmasmensajes();"><span>+</span> <small>Mostrar Mas</small></center></th></tr></table>');

			$("#mostrarmsjs").html(response);
		}
	});
}

function bandeja_salida(){
	$.ajax({
		url : "ajax/bandeja_salida.php",
		beforeSend:function(){
			$("#ajax-loader").html("<img src='img/ajax-loader.gif'/>");
		},
		success:function(response){
			actualizar_no_leidos();
			$("#ajax-loader").html("");
			$("#rerecici").attr("class","");
			$("#enenvivi").attr("class","active");
			$("#botonsisimo").attr("onclick","cargarmasmensajes2();");
			$("#mm").html('<table class="table table-mailbox"><tr><th align="center"><center style="cursor:pointer;" onclick="cargarmasmensajes2();"><span>+</span> <small>Mostrar Mas</small></center></th></tr></table>');

			$("#mostrarmsjs").html(response);
		}
	});
}

function cargar_mensaje_entrada(idm){
	var parametros = {
		"idm" : idm
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/cargar_mensaje_entrada.php",
		beforeSend:function(){
			$("#mm").html("");
			$("#mostrarmsjs").html("<br><br><br><br><center><img src='img/ajax-loader.gif'/></center>");
		},
		success:function(response){
			actualizar_no_leidos();
			$("#mostrarmsjs").html(response);
		}
	});
}

function cargar_mensaje_salida(idm){
	var parametros = {
		"idm" : idm
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/cargar_mensaje_salida.php",
		beforeSend:function(){
			$("#mm").html("");
			$("#mostrarmsjs").html("<br><br><br><br><center><img src='img/ajax-loader.gif'/></center>");
		},
		success:function(response){
			actualizar_no_leidos();
			$("#mostrarmsjs").html(response);
		}
	});
}

function actualizar_no_leidos(){
	$.ajax({
		url : "ajax/actualizar_no_leidos.php",
		success:function(response){
			$("#cant_no_leidos").html(response);
		}
	})
}

function enviar_mensaje(nvirtual){
	var parametros = {
		"nvirtual" : nvirtual
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/enviar_mensaje.php",
		beforeSend:function(){
			$("#mm").html("");
			$("#mostrarmsjs").html("<br><br><br><br><center><img src='img/ajax-loader.gif'/></center>");
		},
		success:function(response){
			$("#mostrarmsjs").html(response);
		}
	});
}

function responder_mensaje(idm){
	var asunto = $("#asunto").val();
	var mensaje = $("#mensaje_a_enviar").val();

	var parametros = {
		"idm" : idm,
		"asunto" : asunto,
		"mensaje" : mensaje
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/responder_mensaje.php",
		beforeSend:function(){
			$("#mostrarmsjs").html("<br><br><br><br><center><img src='img/ajax-loader.gif'/></center>");
		},
		success:function(response){
			bandeja_salida();
		}
	});

}

function enviar_m(nvirtual){
	var asunto = $("#asunto").val();
	var mensaje = $("#mensaje_a_enviar").val();

	var parametros = {
		"nvirtual" : nvirtual,
		"asunto" : asunto,
		"mensaje" : mensaje
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/enviar_m.php",
		beforeSend:function(){
			$("#mostrarmsjs").html("<br><br><br><br><center><img src='img/ajax-loader.gif'/></center>");
		},
		success:function(response){
			bandeja_salida();
		}
	});

}

function buscar_tienda(){

	var busq = $("#busq").val();

	var parametros = {
		"busq" : busq
	};
	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/buscar_tienda.php",
		beforeSend:function(){
			$("#tienda").html("<br><br><br><br><center><img src='img/ajax-loader.gif'/></center>")
		},
		success:function(response){
			$("#tienda").html(response);
		}
	});
}

function busqueda_principal(){
	var cont_buscar = $("#busquedap").val();
	var parametros = {
		"busq" : cont_buscar
	};

	if( $("#busquedap").val()!=""){
		$.ajax({
			data: parametros,
			url : "ajax/busqueda_principal.php",
			beforeSend:function(){
				$("#ppp").html("<br><br><br><center><img src='img/ajax-loader.gif'/></center>");
			},
			success:function(response){
				$("#ppp").html(response);
			}
		});
	}else{
		window.location="./";
	}
}


function busqueda_principal_restar(){
		$.ajax({
			url : "ajax/principal.php",
			beforeSend:function(){
				$("#ppp").html("<br><br><br><center><img src='img/ajax-loader.gif'/></center>");
			},
			success:function(response){
				$("#ppp").html(response);
			}
		});
}

var cnc = 0;

function bloqdesbloq(){

	if(cnc==0){
		cnc=1;
		$("#busquedap").attr("readonly","true");
		$("#busquedap").css("background","#eee");
		$("#busquedap").val('');

		$("#botonb").attr("value","Desbloquear Busqueda");
		$("#botonb").attr("class","btn btn-primary");
	}else{
		$("#busquedap").css("background","#fff");
		$("#busquedap").removeAttr("readonly");

		$("#botonb").attr("value","Bloquear Busqueda");
		$("#botonb").attr("class","btn btn-flat");
		cnc=0;
	}
}

function datos_banco(){
	$.ajax({
		url : "ajax/datos_banco.php",
		beforeSend:function(){
			$("#datos_banco").html('<center><img src="img/ajax-loader.gif"/></center>');
		},
		success:function(response){
			$("#datos_banco").html(response);
		}
	});
}

function ajustar_pierna(l){
	var parametros = {
		"l" : l
	};

	$.ajax({
		data : parametros,
		url : "ajax/ajustar_pierna.php",
		beforeSend:function(){
			$("#ajax-loader").html('<img src="img/ajax-loader.gif"/>');
		},
		success:function(response){
			$("#ajax-loader").html('');
			if(response=="1"){
				$("#btnderecha").attr("class","btn btn-flat btn-default");
				$("#btnizquierda").attr("class","btn btn-flat btn-success");
			}

			if(response=="2"){
				$("#btnizquierda").attr("class","btn btn-flat btn-default");
				$("#btnderecha").attr("class","btn btn-flat btn-success");
			}
		}
	});
}

function cargarproductos(idc){
	var parametros = {
		"idc" : idc
	};

	$.ajax({
		data : parametros,
		type : "post",
		url : "ajax/cargarproductos.php",
		beforeSend:function(){
			$("#productoos").html('<center><img src="img/ajax-loader.gif"/></center>');
		},
		success:function(response){
			$("#productoos").html(response);
		}
	});
}

function volumenizquierdo_conectado(){
	$.ajax({
		url : "ajax/cargarvolumenizquierdo.php",
		beforeSend:function(){
			$("#productoos").html('<center><img src="img/ajax-loader.gif"/></center>');
		},
		success:function(response){
			$("#productoos").html(response);
		}
	});
}

function volumenderecho_conectado(){
	$.ajax({
		url : "ajax/cargarvolumenderecho.php",
		beforeSend:function(){
			$("#productoos").html('<center><img src="img/ajax-loader.gif"/></center>');
		},
		success:function(response){
			$("#productoos").html(response);
		}
	});
}

function directosderecho_conectado(){
	$.ajax({
		url : "ajax/directosderechoconectado.php",
		beforeSend:function(){
			$("#productoos").html('<center><img src="img/ajax-loader.gif"/></center>');
		},
		success:function(response){
			$("#productoos").html(response)
		}
	});
}

function directosizquierda_conectado(){
	$.ajax({
		url : "ajax/directosizquierdaconectado.php",
		beforeSend:function(){
			$("#productoos").html('<center><img src="img/ajax-loader.gif"/></center>');
		},
		success:function(response){
			$("#productoos").html(response)
		}
	});
}

function solicitud(){
	$.ajax({
		url : "ajax/solicitud.php",
		beforeSend:function(){
			$("#ajax-loader").html('<img src="img/ajax-loader.gif"/>');
		},
		success:function(response){
			$("#ajax-loader").html('');
			$("#productoos").html(response);
		}
	});
}

function translado(){
	$.ajax({
		url : "ajax/translado.php",
		beforeSend:function(){
			$("#ajax-loader").html('<img src="img/ajax-loader.gif"/>');
		},
		success:function(response){
			$("#ajax-loader").html('');
			$("#productoos").html(response);
		}
	});
}

function recargar_fondos(){
	$.ajax({
		url : "ajax/recargar_fondos.php",
		beforeSend:function(){
			$("#ajax-loader").html('<img src="img/ajax-loader.gif"/>');
		},
		success:function(response){
			$("#ajax-loader").html('');
			$("#productoos").html(response);
		}
	});
}

function comprar_directo(){
	$.ajax({
		url : "ajax/comprar_directo.php",
		beforeSend:function(){
			$("#ajax-loader").html('<img src="img/ajax-loader.gif"/>');
		},
		success:function(response){
			$("#ajax-loader").html('');
			$("#productoos").html(response);
		}
	});
}
