<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo COMPANY; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/main.css">

	<!--===== Scripts -->
	<?php include "./vistas/modulos/script.php"; ?>
	
</head>
<body>
	<?php  
		$peticionAjax=false;

		require_once "./controladores/vistasControlador.php";

		$vistas = new vistasControlador();
		$vistaRespuesta=$vistas->obtener_vistas_controlador();

		if($vistaRespuesta=="login" || $vistaRespuesta=="404"):
			if($vistaRespuesta=="login")
			{
				require_once "./vistas/contenidos/login-view.php";
			}
			else
			{
				require_once "./vistas/contenidos/404-view.php";
			}
			
		else:
			session_start(['name' => 'SBP']);

			require_once"./controladores/loginControlador.php";
			
			$loginControl = new loginControlador();


			if (!isset($_SESSION['token_sesion']) || !isset($_SESSION['usuario_sesion'])) {

				echo $loginControl->forzarCierreSesion();
			}


	?>
	<!-- SideBar -->
	<?php include "./vistas/modulos/navlateral.php"; ?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">

		<!-- NavBar -->
		<?php include "./vistas/modulos/navbar.php"; ?>
		
		<!-- Content page -->
		<?php require_once $vistaRespuesta; ?>

	</section>

	<?php 
		include "./vistas/modulos/logoutScript.php";

	endif; ?>
	
	<script src="<?php echo SERVERURL; ?>vistas/js/alertas.js" ></script>
	<script>
		$.material.init();
	</script>

</body>
</html>