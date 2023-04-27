$(document).ready(function() {

	/**
	 * Registra un usuario
	 */
	 $('#register-form').submit(function(event) {
			// Prevenir que el formulario se envíe automáticamente
			event.preventDefault(); 

		    // Obtener los datos del formulario
		    var formData = $(this).serialize();

		    // Enviar los datos del formulario mediante AJAX
		    $.ajax({
		    	type: 'POST',
		    	url: 'index.php?ajax=true&registrar',
		    	data: formData,
		    	dataType:'JSON',

		    	success: function(data) {
		    		console.log(data)
		    		if(data.estado)
		    		{
		    			alert(data.mensaje)
		    			location.href = 'index.php?pagina=bienvenido';
		    		}
		    		else
		    		{
		    			alert(data.mensaje)
		    		}
		    	},
		    	error: function(jqXHR, textStatus, errorThrown) {
		    		console.log(textStatus, errorThrown);
		    	}
		    });
		});

	/**
	 * Logear usuario
	 */
	 $('#login-form').submit(function(event) {
		// Prevenir que el formulario se envíe automáticamente
		event.preventDefault(); 

	    // Obtener los datos del formulario
	    var formData = $(this).serialize();

	    // Enviar los datos del formulario mediante AJAX
	    $.ajax({
	    	type: 'POST',
	    	url: 'index.php?ajax=true&loguear',
	    	data: formData,
	    	dataType:'JSON',

	    	success: function(data) {
	    		console.log(data)
	    		if(data.estado)
	    		{
	    			alert(data.mensaje)
	    			location.href = 'index.php?pagina=bienvenido';
	    		}
	    		else
	    		{
	    			alert(data.mensaje)
	    		}
	    	},
	    	error: function(jqXHR, textStatus, errorThrown) {
	    		console.log(textStatus, errorThrown);
	    	}
	    });
	});
	});	