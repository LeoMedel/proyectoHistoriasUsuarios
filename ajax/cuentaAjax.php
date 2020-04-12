<?php
	
	$peticionAjax = true;

	require_once "../core/configGeneral.php";

	if (isset($_POST['CodigoCuenta-up']))
	{
		

		require_once "../controladores/cuentaControlador.php";
		$insCuenta = new cuentaControlador();

		if (isset($_POST['CodigoCuenta-up']) && isset($_POST['TipoCuenta-up']) && isset($_POST['userLog-up']) && isset($_POST['passwordLog-up'])) 
		{

			echo $insCuenta->actualizarCuentaControlador();
		}

	} 
	else
	{
		session_start(['name' => 'SBP']);
		session_destroy();
		echo '<script> window.location.href="'.SERVERURL.'login/"  </script>';
	}
	

