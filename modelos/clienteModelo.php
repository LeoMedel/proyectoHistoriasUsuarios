<?php
	
	if($peticionAjax)
	{
		require_once "../core/modeloPrincipal.php";
	}
	else
	{
		require_once "./core/modeloPrincipal.php";
	}


	class clienteModelo extends modeloPrincipal
	{

		protected function agregarClienteModelo($datos)
		{
			try
			{
				$pdo = modeloPrincipal::conectarBD();
				

				$sql = "INSERT INTO cliente(ClienteDNI, ClienteNombre, ClienteApellido, ClienteTelefono, ClienteOcupacion, ClienteDireccion, CuentaCodigo) VALUES(?, ?, ?, ?, ?, ?, ?)";


				$pdo->prepare($sql)->execute([
					$datos['DNI'], 
					$datos['Nombre'], 
					$datos['Apellidos'], 
					$datos['Telefono'], 
					$datos['Ocupacion'],
					$datos['Direccion'], 
					$datos['Codigo']
				]);
				return true;

			}
			catch (Exception $e) 
			{
				return false;
			}
		}

	}