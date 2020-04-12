<?php
	
	$peticionAjax = true;

	require_once "../core/configGeneral.php";

	if (isset($_POST['dni-reg']) || isset($_POST['codigo-del']))
	{
		
		require_once "../controladores/administradorControlador.php";
		$insAdministrador = new administradorControlador();

		//Agregar
		if (isset($_POST['dni-reg']) && isset($_POST['nombre-reg']) && isset($_POST['apellido-reg']) && isset($_POST['usuario-reg']))
		{
			echo $insAdministrador->agregarAdministradorControlador();
		}

		//Eliminar
		if (isset($_POST['codigo-del']) && isset($_POST['privilegio-admin']) ) 
		{
			echo $insAdministrador->eliminarAdministradorControlador();
		}
	} 
	else
	{
		session_start();
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"  </script>';
	}
	

