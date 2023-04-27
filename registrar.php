<?php defined('VRF') || exit; ?>

<title>Registro de usuario</title>

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					Registro de usuario
				</div>
				<div class="card-body">
					<form id="register-form">
						<div class="form-group">
							<label for="nombre">Nombre completo</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre completo">
						</div>
						<div class="form-group">
							<label for="email">Correo electrónico</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo electrónico">
						</div>
						<div class="form-group">
							<label for="password">Contraseña</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña">
						</div>
						<button type="submit" class="btn btn-primary">Registrar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
