<?php defined('VRF') || exit;

/* Este archivo implementa un ejemplo basico
 * del patron de diseño Front Controller 
 */



include 'usuario.class.php';
$usuario = new Usuario();

/* Comprueba si es una solicitud AJAX */
if(isset($_GET['ajax']))
{
	include 'ajax.php';
}
else
{
	/* Incluye la pagina solicitada */
	if(isset($_GET['pagina']) AND !empty($_GET['pagina']))
	{
		/* Verifica que el usuario esté logueado */
		if(!empty($usuario->d) OR in_array($_GET['pagina'], $sitios_permitidos))
		{
			/* Si existe la pagina solicitada */
			if(file_exists($_GET['pagina'] . '.php'))
			{
				/* incluye cabecera */
				include "head.php";

				/* Incluye pagina¨*/
				include $_GET['pagina'] . '.php';

				/* incluye footer */
				include 'footer.php';
			}
			else
			{
				/* Incluye pagina 404¨*/
				include '404.php';
			}

		}
		else
		{
			redireccionar('login');
		}
	}
	else
	{
		redireccionar('login');
	}
}

?>