<div class="full-box login-container cover">
	<form action="" method="POST" autocomplete="off" class="logInForm">
		<p class="text-center text-muted"><i class="zmdi zmdi-desktop-windows zmdi-hc-5x"></i></p>
		<p class="text-center text-muted text-uppercase">Iniciar sesión</p>
		<div class="form-group label-floating">
		  <label class="control-label" for="UserName">Usuario</label>
		  <input required="" class="form-control" id="UserName" name="usuario" type="text" style="color: #FFF;">
		  <p class="help-block">Ingresa tu usuario</p>
		</div>
		<div class="form-group label-floating">
		  <label class="control-label" for="UserPass">Contraseña</label>
		  <input required="" class="form-control" id="UserPass" name="clave" type="password" style="color: #FFF;">
		  <p class="help-block">Ingresa tu contraseña</p>
		</div>
		<div class="form-group text-center">
			<input type="submit" value="ENTRAR" class="btn btn-info btn-block btn-lg" style="color: #FFF;">
		</div>
	</form>
</div>


<?php
	if (isset($_POST['usuario']) && isset($_POST['clave'])) {
		require_once "./controladores/loginControlador.php";

		$login = new loginControlador();

		echo $login->iniciarSesionControlador();
	} 

?>