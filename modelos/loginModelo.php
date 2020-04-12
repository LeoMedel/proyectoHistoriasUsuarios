<?php
	
	if($peticionAjax)
	{
		require_once "../core/modeloPrincipal.php";
	}
	else
	{
		require_once "./core/modeloPrincipal.php";
	}



	/**
	 * 
	 */
	class loginModelo extends modeloPrincipal
	{
		protected function iniciarSesionModelo($datos)
		{
			try
			{
				$datosSesion = self::conectarBD()->prepare("SELECT * FROM cuenta WHERE CuentaUsuario = ? AND CuentaClave = ? AND CuentaEstado = 'Activo'");

				$datosSesion->execute([
						$datos['Usuario'],
						$datos['Clave']
					]);
				
				return $datosSesion;
			}
			catch(Exception $e)
			{
				return $datosSesion;
			}
		}


		protected function cerrarSesionModelo($datos)
		{
			if ($datos['TokenSesion']==$datos['TokenPagina'])
			{
				if ($datos['Usuario'] != "")
				{
					$bitacora = modeloPrincipal::actualizarBitacora($datos['Codigo'], $datos['Hora']);

					if ($bitacora)
					{
						session_unset();
						session_destroy();

						return "true";
					}
					else
					{
						return "bitacora";
					}
				}
				else
				{
					return "usuario";
				}
				
				
				
			}
			else
			{
				return "token";
			}

			return "false";
			
		}

	}