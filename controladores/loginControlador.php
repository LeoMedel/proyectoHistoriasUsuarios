<?php
	
	if($peticionAjax)
	{
		require_once "../modelos/loginModelo.php";
	}
	else
	{
		require_once "./modelos/loginModelo.php";
	}

	/**
	 * 
	 */
	class loginControlador extends loginModelo
	{
		public function iniciarSesionControlador()
		{
			$usuario = modeloPrincipal::limpiarCadena($_POST['usuario']);
			$clave = modeloPrincipal::limpiarCadena($_POST['clave']);

			$clave = modeloPrincipal::encriptar($clave);

			$datosLogin = [
				"Usuario" => $usuario,
				"Clave" => $clave
			];

			$datosCuenta = loginModelo::iniciarSesionModelo($datosLogin);

			if ($datosCuenta->rowCount()==1) {
				
				$registro = $datosCuenta->fetch();

				$fechaActual = date("Y-m-d");
				$yearActual = date("Y");
				$horaActual = date("h:i:s a");

				$consulta1 = modeloPrincipal::ejecutarConsultaSimpleSQL("SELECT id FROM bitacora");

				$numero = ($consulta1->rowCount())+1;

				$codigoBitacora = modeloPrincipal::generarCodigo("CB", 5, $numero);

				$datosBitacora = [
					"Codigo" => $codigoBitacora,
					"Fecha" => $fechaActual,
					"HoraInicio" => $horaActual,
					"HoraFinal" => "Sin registro",
					"Tipo" => $registro['CuentaTipo'],
					"Year" => $yearActual,
					"Cuenta" => $registro['CuentaCodigo']
				];

				$bitacoraInsertada = modeloPrincipal::guardarBitacora($datosBitacora);

				if($bitacoraInsertada)
				{
					session_start(['name' => 'SBP']);
					$_SESSION['usuario_sesion'] = $registro['CuentaUsuario'];
					$_SESSION['tipo_sesion'] = $registro['CuentaTipo'];
					$_SESSION['privilegio_sesion'] = $registro['CuentaPrivilegio'];
					$_SESSION['foto_sesion'] = $registro['CuentaFoto'];
					$_SESSION['token_sesion'] = md5(uniqid(mt_rand(), true));
					$_SESSION['codigo_cuenta_sesion'] = $registro['CuentaCodigo'];
					$_SESSION['codigo_bitacora_sesion'] = $codigoBitacora;


					if ($registro['CuentaTipo'] == "Administrador")
					{
						$url = SERVERURL."home/";
					} 
					else
					{
						$url = SERVERURL."catalog/";
					}
					
					return $urlLocation = '<script>window.location="'.$url.'"</script>';

				}
				else
				{
					$alerta = [
						"Alerta" => "simple",
						"Titulo" => "Error",
						"Texto" => "El sistema NO pudo iniciar sesion por problemas tecnicos. Intentelo nuevamente.",
						"Tipo" => "error"
					];
				}
			}
			else
			{
				$alerta = [
					"Alerta" => "simple",
					"Titulo" => "Error",
					"Texto" => "Usuario o Contraseña incorrecta. La cuenta puede estar desactivada",
					"Tipo" => "error"
				];

				return modeloPrincipal::mostrarAlerta($alerta);
			}
		}

		public function cerrarSesionControlador()
		{
			session_start(['name' => 'SBP']);

			$token = modeloPrincipal::desencriptar($_GET['Token']);

			$hora = date("h:i:s a");

			$datosLogin = [
				"Usuario" => $_SESSION['usuario_sesion'],
				"TokenSesion" => $_SESSION['token_sesion'],
				"TokenPagina" => $token,
				"Codigo" => $_SESSION['codigo_bitacora_sesion'],
				"Hora" => $hora

			];

			return loginModelo::cerrarSesionModelo($datosLogin);

		}

		public function forzarCierreSesion()
		{
			session_destroy();
			return header("Location: ".SERVERURL."login/");
		}
	}