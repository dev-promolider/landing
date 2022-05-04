$(document).ready(function(){

	document.getElementById("registro").reset();

	function ocultarRegistro()
	{
		$('#registro').addClass('hidden');
	}

	function mostrarRegistro()
	{
		$('#registro').removeClass('hidden').hide().fadeIn('slow');
	}

	function ocultarLogin()
	{
		$('#login').addClass('hidden');
	}

	function mostrarLogin()
	{
		$('#login').removeClass('hidden').hide().fadeIn('slow');
	}

	//MODAL REGISTRO - LOGIN
	$('.tipoFormulario').bind('click', function(e){

		var id = $(this).attr('attr-id');

		if(id=="login" && $('#login').hasClass('hidden'))
		{
			$('#formPop li').removeClass();
			$("#formPop li[attr-id$='login']").addClass('active');
			ocultarRegistro();
			mostrarLogin();
		}
		else if(id=="registro" && $('#registro').hasClass('hidden'))
		{
			$('#formPop li').removeClass();
			$("#formPop li[attr-id$='registro']").addClass('active');
			ocultarLogin();
			mostrarRegistro();
		}

	});

	$('.btn-nocomprar').bind('click', function(e){

		$("#idproducto").val("");
		$("#idtipocuenta").val("");

	});

	

	$('#header-menu li > a').click(function() {
	    $('#header-menu li').removeClass();
	    $(this).parent().addClass('active');
	});


	$('#reg-pais').on('change', function() {

		var pais = $("#reg-pais").val();

		if(pais!="")
		{
			$.ajax({
				url: "lib/funciones.php",
				type: "post",
				data: {
					"idpais": pais,
					"funcion": "obtenerEstados",
				},

				beforeSend: function(){

					$("#reg-estado").html("<option value=''><span class='glyphicon glyphicon-repeat glyphicon-refresh-animate'></span> Cargando...</option>");

				},
				success: function (resultado) {

					$("#reg-estado").prop("disabled", false);
					$("#reg-estado").html(resultado);

				}

			})
		}
		else
		{
			$("#reg-estado").html('<option value="">Estado</option>');
			$("#reg-estado").prop("disabled", true);
		}

	    
	});


	$('#reg-tipocuenta').on('change', function() {

		var tipocuenta = $("#reg-tipocuenta").val();

		if(tipocuenta!="")
		{
			$("#idtipocuenta").val($('option:selected', this).attr('attr-id'));

			$.ajax({
				url: "lib/funciones.php",
				type: "post",
				data: {
					"idtipo": tipocuenta,
					"funcion": "obtenerTipoCuenta",
				},
				dataType: 'json',

				beforeSend: function(){

					$("#tipocuenta-data").removeClass('hidden').hide().fadeIn('slow');

				},
				success: function (resultado) {

					var precioyiva = (parseInt(resultado.precio)*parseInt(resultado.iva))/100;
					var precioyiva = parseInt(precioyiva)+parseInt(resultado.precio);

					$("#tipocuenta-data").html('<div class="form-group"><label class="col-md-12">Precio: '+resultado.precio+'</label>	<label class="col-md-12">Comisionable: '+resultado.comisionable+'</label>		<label class="col-md-12">Iva: '+resultado.iva+'</label> <label class="col-md-12">Precio + IVA: '+parseInt(precioyiva)+'</label></div>');
				}

			})
		}
		else
		{
			$("#tipocuenta-data").addClass('hidden');
		}

	    
	});


	$(".formRegistro").on("submit",function(e){

		e.preventDefault();
		e.stopImmediatePropagation();

		var data = $(this).serialize();
		var idproducto = $("#idproducto").val();
		var idsafip = $("#idtipocuenta").val();

	 	$.ajax({

        type:'POST',
        url:'lib/funciones.php',
        data: data,
        beforeSend: function(){

			$("#info").removeClass('alert-success');
			$("#info").addClass('alert-info');
			$("#info").html("Cargando ... ");
			$("#info").removeClass('hidden').hide().fadeIn('slow');

		},
        success: function(resultado) {

        	$("#info").addClass('hidden');
			$("#info").removeClass('alert-info');
			$("#info").addClass('alert-success');

			//document.getElementById("registro").reset();

			var band = 0;

			console.log(resultado);

        	var end = jQuery.parseJSON(resultado);

        	$("#"+end[0]).removeClass('hidden').hide().fadeIn('fast');
        	$("#"+end[0]).html(end[1]);

        	if(end[0] == "info")
        	{
        		if(end[2]=="Registrado")
        		{
        			if(idproducto!="")
    				{
    					band = 1;
    					cant = 1;

						var parametros = {
							"idp" : idproducto,
							"cant" : cant
						};

						$.ajax({
							data : parametros,
							type : "POST",
							url : "ajax/agregar.php",

							beforeSend: function() {
								
							},
							success:function(response){

								var band = 1;
								
							}
						});
					}

					if(idsafip!="")
					{
						band = 1;
						cant = 1;

						var parametros = {
							"idp" : idsafip,
							"cant" : cant
						};

						$.ajax({
							data : parametros,
							type : "post",
							url : "ajax/agregar.php",
							beforeSend:function(){
								
							},
							success:function(response){

								var band = 1;
								
							}
						});
					}

					if(band == 1)
					{
						setTimeout(function() {
						  window.location.href = "index.php?p=carrito";
						}, 3000);
					}
					else
					{
						setTimeout(function() {
						  window.location.href = "index.php";
						}, 3000);
					}
					
        		}

        	}

        	console.log(resultado);

        },
        error: function(xhr, ajaxOptions, thrownError) {
	        alert(xhr.status);
	        alert(thrownError);
      	}
        });
	})



	$(".formLogin").on("submit",function(e){

		e.preventDefault();
		e.stopImmediatePropagation();

		var data = $(this).serialize();
		var idproducto = $("#idproducto").val();
		var idsafip = $("#idtipocuenta").val();

	 	$.ajax({

        type:'POST',
        url:'lib/funciones.php',
        data: data,
        beforeSend: function(){

			$("#info-login").addClass('alert-info');
			$("#info-login").html("Cargando ... ");
			$("#info-login").removeClass('hidden').hide().fadeIn('slow');

		},
        success: function(resultado) {

        	$("#info-login").addClass('hidden');
			$("#info-login").removeClass('alert-info');

			var band = 0;

			console.log(resultado);

        	var end = jQuery.parseJSON(resultado);

        	$("#info-login").removeClass('alert-info');
        	$("#info-login").removeClass('alert-danger');
        	$("#info-login").removeClass('alert-success');


        	$("#"+end[0]).addClass(end[2]);
        	$("#"+end[0]).removeClass('hidden').hide().fadeIn('fast');
        	$("#"+end[0]).html(end[1]);

        	if(end[0] == "info-login")
        	{
        		if(end[2]=="alert-success")
        		{
        			if(idproducto!="")
    				{
    					band = 1;
    					cant = 1;

						var parametros = {
							"idp" : idproducto,
							"cant" : cant
						};

						$.ajax({
							data : parametros,
							type : "POST",
							url : "ajax/agregar.php",

							beforeSend: function() {
								
							},
							success:function(response){

								var band = 1;
								
							}
						});
					}

					if(idsafip!="")
					{
						band = 1;
						cant = 1;

						var parametros = {
							"idp" : idsafip,
							"cant" : cant
						};

						$.ajax({
							data : parametros,
							type : "post",
							url : "ajax/agregar.php",
							beforeSend:function(){
								
							},
							success:function(response){

								var band = 1;
								
							}
						});
					}

					if(band == 1)
					{
						setTimeout(function() {
						  window.location.href = "index.php?p=carrito";
						}, 3000);
					}
					else
					{
						setTimeout(function() {
						  window.location.href = "index.php";
						}, 3000);
					}
					
        		}

        	}

        	console.log(resultado);

        },
        error: function(xhr, ajaxOptions, thrownError) {
	        alert(xhr.status);
	        alert(thrownError);
      	}
        });
	})

	$('.btn-comprar').on('click', function(){
		$('#idproducto').val($(this).attr('attr-id'))
	})

	/*$('.btn').on('click', function() {
	    var $this = $(this);
	  $this.button('loading');
	    setTimeout(function() {
	       $this.button('reset');
	   }, 8000);
	});*/


})