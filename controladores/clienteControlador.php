<?php
	
	if($peticionAjax)
	{
		require_once "../modelos/clienteModelo.php";
	}
	else
	{
		require_once "./modelos/clienteModelo.php";
	}


	class clienteControlador extends clienteModelo
	{
		public function agregarClienteControlador()
		{

			//Cliente
			$dni = modeloPrincipal::limpiarCadena($_POST['dni-reg']);
			$nombre = modeloPrincipal::limpiarCadena($_POST['nombre-reg']);
			$apellido = modeloPrincipal::limpiarCadena($_POST['apellido-reg']);
			$telefono = modeloPrincipal::limpiarCadena($_POST['telefono-reg']);
			$ocupacion = modeloPrincipal::limpiarCadena($_POST['ocupacion-reg']);
			$direccion = modeloPrincipal::limpiarCadena($_POST['direccion-reg']);

			//Cuenta
			$usuario = modeloPrincipal::limpiarCadena($_POST['usuario-reg']);
			$password1 = modeloPrincipal::limpiarCadena($_POST['password1-reg']);
			$password2 = modeloPrincipal::limpiarCadena($_POST['password2-reg']);
			$email = modeloPrincipal::limpiarCadena($_POST['email-reg']);
			$genero = modeloPrincipal::limpiarCadena($_POST['optionsGenero']);

			$privilegio = 4;


			if ($genero == "Masculino") 
			{
				$foto = "Male2Avatar.png";
			} 
			else 
			{
				$foto = "Female1Avatar.png";
			}


			if($password1!= $password2)
			{
				$alerta = [
						"Alerta" => "simple",
						"Titulo" => "Error",
						"Texto" => "Las contraseñas NO coinciden, verifique nuevamente",
						"Tipo" => "error"
					];
			}
			else
			{
				$consulta = modeloPrincipal::ejecutarConsultaSimpleSQL("SELECT ClienteDNI FROM cliente WHERE ClienteDNI='$dni'");

				if ($consulta->rowCount()>=1)
				{
					$alerta = [
						"Alerta" => "simple",
						"Titulo" => "Error",
						"Texto" => "El DNI ya esta registrado, verifique nuevamente",
						"Tipo" => "error"
					];

				}
				else
				{
					//Verificar EMAIL
					if ($email!="")
					{
						$consulta2 = modeloPrincipal::ejecutarConsultaSimpleSQL("SELECT CuentaEmail FROM cuenta WHERE CuentaEmail='$email'");

						$existeEmail = $consulta2->rowCount();

					} else {
						$existeEmail = 0;
					}

					if ($existeEmail >=1)
					{
						$alerta = [
							"Alerta" => "simple",
							"Titulo" => "Error",
							"Texto" => "El EMAIL ya esta registrado, verifique nuevamente ".$email." ",
							"Tipo" => "error"
						];
					}
					else
					{
						$consulta3 = modeloPrincipal::ejecutarConsultaSimpleSQL("SELECT CuentaUsuario FROM cuenta WHERE CuentaUsuario='$usuario'");

						if ($consulta3->rowCount()>=1)
						{
							$alerta = [
							"Alerta" => "simple",
							"Titulo" => "Error",
							"Texto" => "El USUARIO ya esta registrado, verifique nuevamente",
							"Tipo" => "error"
						];

						}
						else
						{
							$consultaID = modeloPrincipal::ejecutarConsultaSimpleSQL("SELECT id FROM cuenta");

							$numero = ($consultaID->rowCount())+1;

							$codigo = modeloPrincipal::generarCodigo("JC", 5, $numero);

							$clave = modeloPrincipal::encriptar($password1);

								$datosCuenta = [
									"Codigo" => $codigo,
									"Privilegio" => $privilegio,
									"Usuario" => $usuario,
									"Clave" => $clave,
									"Email" => $email,
									"Estado" => "Activo",
									"Tipo" => "Cliente",
									"Genero" => $genero,
									"Foto" => $foto
								];

							$cuentaAgregada = modeloPrincipal::agregarCuenta($datosCuenta);

							if ($cuentaAgregada)
								{
									
									$datosCliente = [
										"DNI" => $dni,
										"Nombre" => $nombre,
										"Apellidos" => $apellido,
										"Telefono" => $telefono,
										"Ocupacion" => $ocupacion,
										"Direccion" => $direccion,
										"Codigo" => $codigo
									];

									$clienteAgregado = clienteModelo::agregarClienteModelo($datosCliente);

									if ($clienteAgregado)
									{
										$alerta = [
											"Alerta" => "limpiar",
											"Titulo" => "Éxito",
											"Texto" => "CLIENTE registrado con éxito",
											"Tipo" => "success"
										];
									} 
									else
									{
										modeloPrincipal::eliminarCuenta($codigo);

										$alerta = [
											"Alerta" => "simple",
											"Titulo" => "Error",
											"Texto" => "El CLIENTE NO pudo ser registrado. Verifique nuevamente",
											"Tipo" => "error"
										];
									}
									

								}
								else
								{
									$alerta = [
										"Alerta" => "simple",
										"Titulo" => "Error",
										"Texto" => "La CUENTA NO pudo ser registrada. Verifique nuevamente",
										"Tipo" => "error"
									];
								}



						}
						


					}
					
					
				}
				


			}



			return modeloPrincipal::mostrarAlerta($alerta);

		}
		
	}