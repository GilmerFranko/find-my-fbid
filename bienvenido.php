<?php defined('VRF') || exit; ?>

<!DOCTYPE html>


<body>
	Bienvenido <strong><?php echo $usuario->d->nombre ?></strong>
	<p><a href="<?php echo crearUrl('logout'); ?>">Cerrar Session</a></p>
</body>
