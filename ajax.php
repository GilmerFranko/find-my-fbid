<?php defined('VRF') || exit;
/* Este archivo se encarga de manejar las peticiones ajax */

/**
 * Registra un usuario
 */
if(isset($_GET['registrar']))
{
	/**
	 * Verifica todos los datos
	 */
	if(
		isset($_POST['nombre']) AND !empty($_POST['nombre']) AND
		isset($_POST['email']) AND !empty($_POST['email']) AND
		isset($_POST['password']) AND !empty($_POST['password'])
	)
	{

		$nombre = $_POST['nombre'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		/* Verificar que el email sea válido */
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$mensaje = array(
				'estado' => false,
				'mensaje' => "Por favor ingrese un correo electrónico válido"
			);
		}
		else
		{
			/* Verificar que el password tenga al menos 8 caracteres y al menos 1 número y 1 caracter especial */
			if(preg_match('/^(?=.*[!@#$%^&*()\-_=+{};:,<.>‌​?])(?=.*[a-zA-Z])(?=.*\d).{8,}$/', $password))
			{
				if(!$usuario->registrar($nombre, $email, $password))
				{
					$mensaje = $mensaje = array(
						'estado' => false,
						'mensaje' =>$usuario->error
					);
				}
				else
				{
					$mensaje = $mensaje = array(
						'estado' => true,
						'mensaje' => 'Registro Exitoso'
					);
				}

			}
			else
			{
				$mensaje = $mensaje = array(
					'estado' => false,
					'mensaje' => "La contraseña debe tener al menos 8 caracteres y contener al menos 1 número y 1 carácter especial"
				);
			}
		}
	}
	else
	{
		$mensaje = $mensaje = array(
			'estado' => false,
			'mensaje' => 'No se han podido verificar todos los datos, por favor asegúrese de rellenar el formulario correctamente'
		);
	}

	echo json_encode($mensaje);
	exit;
}

if(isset($_GET['loguear']))
{
	/**
	 * Verifica todos los datos
	 */
	if(
		isset($_POST['email']) AND !empty($_POST['email']) AND
		isset($_POST['password']) AND !empty($_POST['password'])
	)
	{

		$email = $_POST['email'];
		$password = $_POST['password'];

		/* Verificar que el email sea válido */
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$mensaje = array(
				'estado' => false,
				'mensaje' => "Por favor ingrese un correo electrónico válido"
			);
		}
		else
		{
			
			$u = $usuario->getUsuario($email);

			if(is_array($u))
			{

				// VERIFICAR CONTRASEÑA
				if (password_verify($password, $u['password']) === true)
				{
					$usuario->loguear($u['id']);

					$mensaje = $mensaje = array(
						'estado' => true,
						'mensaje' => 'Has sido identificado'
					);
				}
				else
				{
					$mensaje = $mensaje = array(
						'estado' => false,
						'mensaje' => 'La combinación de email y contraseña es incorrecta, inténtelo nuevamente.'
					);
				}
			}
			else
			{
				$mensaje = $mensaje = array(
					'estado' => false,
					'mensaje' => 'La combinación de email y contraseña es incorrecta, inténtelo nuevamente.'
				);
			}

		}

	}
	else
	{
		$mensaje = $mensaje = array(
			'estado' => false,
			'mensaje' => 'No se han podido verificar todos los datos, por favor asegúrese de rellenar el formulario correctamente'
		);
	}

	echo json_encode($mensaje);
	exit;
}

?>