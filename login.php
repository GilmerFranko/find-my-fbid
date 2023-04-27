<?php defined('VRF') || exit; ?>

<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						Iniciar sesión
					</div>
					<div class="card-body">
						<form id="login-form">
							<div class="form-group">
								<label for="email">Correo electrónico</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo electrónico">
							</div>
							<div class="form-group">
								<label for="password">Contraseña</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña">
							</div>
							<br>
							<p>¿No estas registrado? <a href="<?php echo crearUrl('registrar') ?>">Registrate</a></p>
							<button type="submit" class="btn btn-primary">Iniciar sesión</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>