<?php
	
	if($peticionAjax)
	{
		require_once "../core/modeloPrincipal.php";
	}
	else
	{
		require_once "./core/modeloPrincipal.php";
	}


	class administradorModelo extends modeloPrincipal
	{
		protected function agregarAdministradorModelo($datosAdm)
		{
			/*
			$agregarAdmin = modeloPrincipal::conectarBD()->prepare("INSERT INTO admin(AdminDNI,AdminNombre,AdminApellido,AdminTelefono,AdminDireccion,CuentaCodigo) VALUES(:DNI,:Nombre,:Apellidos,:Telefono,:Direccion,:Codigo)");

			$agregarAdmin->bindParam(":DNI", $datosAdm['DNI']);
			$agregarAdmin->bindParam(":Nombre", $datosAdm['Nombre']);
			$agregarAdmin->bindParam(":Apellidos", $datosAdm['Apellidos']);
			$agregarAdmin->bindParam(":Telefono", $datosAdm['Telefono']);
			$agregarAdmin->bindParam(":Direccion", $datosAdm['Direccion']);
			$agregarAdmin->bindParam(":Codigo", $datosAdm['Codigo']);

			$agregarAdmin->execute();

			return $agregarAdmin;
			*/

			try
			{
				$pdo = modeloPrincipal::conectarBD();
				

				$sql = "INSERT INTO admin(AdminDNI, AdminNombre, AdminApellido, AdminTelefono, AdminDireccion, CuentaCodigo) VALUES(?, ?, ?, ?, ?, ?)";


				$pdo->prepare($sql)->execute([
					$datosAdm['DNI'], 
					$datosAdm['Nombre'], 
					$datosAdm['Apellidos'], 
					$datosAdm['Telefono'], 
					$datosAdm['Direccion'], 
					$datosAdm['Codigo']
				]);
				

				return true;

			} catch (Exception $e) 
			{
				return false;
			}
		}

		protected function eliminarAdministradorModelo($codigo)
		{
			$eliminar = modeloPrincipal::conectarBD()->prepare("DELETE FROM admin WHERE CuentaCodigo=:Codigo");

			$eliminar->bindParam("Codigo", $codigo);

			$eliminar->execute();

			return $eliminar;

		}
	}