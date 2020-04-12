<?php
	if($peticionAjax)
	{
		require_once "../core/configAPP.php";
	}
	else
	{
		require_once "./core/configAPP.php";
	}


	class modeloPrincipal
	{
		protected function conectarBD()
		{
			try {
		    	$pdo = new PDO(SGBD, "root", "");
		    	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	        
		    	return $pdo;

		    } catch (PDOException $exception)
		    {
		    	die ('Failed to connect to database!');
		    }
		}

		protected function ejecutarConsultaSimpleSQL($consulta)
		{
			$resultado = self::conectarBD()->prepare($consulta);

			$resultado->execute();

			return $resultado;
		}

		/*Encriptar cadenas*/
		public function encriptar($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}


		/*Desencriptar cadenas*/
		protected static function desencriptar($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}


		protected function agregarCuenta($datosCuenta)
		{
			try
			{
				$pdo = self::conectarBD();
				

				$sql = "INSERT INTO cuenta(CuentaCodigo, CuentaPrivilegio, CuentaUsuario, CuentaClave, CuentaEmail, CuentaEstado, CuentaTipo, CuentaGenero, CuentaFoto) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";


				$pdo->prepare($sql)->execute([
					$datosCuenta['Codigo'], 
					$datosCuenta['Privilegio'], 
					$datosCuenta['Usuario'], 
					$datosCuenta['Clave'], 
					$datosCuenta['Email'], 
					$datosCuenta['Estado'],
					$datosCuenta['Tipo'],
					$datosCuenta['Genero'],
					$datosCuenta['Foto']
				]);
				

				return true;

			} catch (Exception $e) 
			{
				return false;
			}


		}

		protected function eliminarCuenta($codigoCuenta)
		{
			$eliminar = self::conectarBD()->prepare("DELETE FROM cuenta WHERE CuentaCodigo=:Codigo");

			$eliminar->bindParam("Codigo", $codigoCuenta);

			$eliminar->execute();

			return $eliminar;

		}

		protected function guardarBitacora($datos)
		{
			try
			{
				$pdo = self::conectarBD();

				$sql = "INSERT INTO bitacora(BitacoraCodigo,BitacoraFecha,BitacoraHoraInicio,BitacoraHoraFinal,BitacoraTipo,Bitacorayear,CuentaCodigo) VALUES (?,?,?,?,?,?,?)";

				$pdo->prepare($sql)->execute([
						$datos['Codigo'], 
						$datos['Fecha'], 
						$datos['HoraInicio'], 
						$datos['HoraFinal'], 
						$datos['Tipo'], 
						$datos['Year'],
						$datos['Cuenta']
					]);
				return true;
			}
			catch(Exception $e)
			{
				return false;
			}
		}

		protected function actualizarBitacora($codigo, $hora)
		{
			try
			{
				/*
				$pdo = self::conectarBD();
				$sql = "UPDATE bitacora SET BitacoraHoraFinal =? WHERE BitacoraCodigo=?";
				$pdo->prepare($sql)->execute([
						$hora,
						$codigo
					]);
				return true;
				*/
				$actualizar = self::conectarBD()->prepare("UPDATE bitacora SET BitacoraHoraFinal =:Hora WHERE BitacoraCodigo=:Codigo");

				$actualizar->bindParam(":Hora", $hora);
				$actualizar->bindParam(":Codigo", $codigo);

				$actualizar->execute();

				return true;
			}
			catch(Exception $e)
			{
				return false;
			}
		}

		protected function eliminarBitacora($codigo)
		{
			try
			{
				$pdo = self::conectarBD();

				$sql = "DELETE FROM bitacora WHERE CuentaCodigo=?";

				$pdo->prepare($sql)->execute([
						$codigo
					]);
				
				return true;
			}
			catch(Exception $e)
			{
				return false;
			}
		}


		/*Codigos Aleatorios*/
		protected function generarCodigo($letra,$longitud,$numero)
		{
			for($i=1; $i<=$longitud; $i++)
			{
				$aleatorio= rand(0,9);
				$letra.=$aleatorio;
			}
			return $letra."-".$numero;
		}

		/*Limpiar cadenas para que no exita Inyeccion SQL*/
		protected static function limpiarCadena($cadena){
			$cadena=trim($cadena);
			$cadena=stripslashes($cadena);
			$cadena=str_ireplace("<script>", "", $cadena);
			$cadena=str_ireplace("</script>", "", $cadena);
			$cadena=str_ireplace("<script src", "", $cadena);
			$cadena=str_ireplace("<script type=", "", $cadena);
			$cadena=str_ireplace("SELECT * FROM", "", $cadena);
			$cadena=str_ireplace("DELETE FROM", "", $cadena);
			$cadena=str_ireplace("INSERT INTO", "", $cadena);
			$cadena=str_ireplace("DROP TABLE", "", $cadena);
			$cadena=str_ireplace("DROP DATABASE", "", $cadena);
			$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
			$cadena=str_ireplace("SHOW TABLES", "", $cadena);
			$cadena=str_ireplace("SHOW DATABASES", "", $cadena);
			$cadena=str_ireplace("<?php", "", $cadena);
			$cadena=str_ireplace("?>", "", $cadena);
			$cadena=str_ireplace("--", "", $cadena);
			$cadena=str_ireplace(">", "", $cadena);
			$cadena=str_ireplace("<", "", $cadena);
			$cadena=str_ireplace("[", "", $cadena);
			$cadena=str_ireplace("]", "", $cadena);
			$cadena=str_ireplace("^", "", $cadena);
			$cadena=str_ireplace("==", "", $cadena);
			$cadena=str_ireplace(";", "", $cadena);
			$cadena=str_ireplace("::", "", $cadena);
			$cadena=stripslashes($cadena);
			$cadena=trim($cadena);
			return $cadena;
		}


		/**/
		protected function mostrarAlerta($datosAlerta)
		{
			if($datosAlerta['Alerta']==="simple")
			{
				$alerta = "
					<script>
						swal(
							'".$datosAlerta['Titulo']."',
							'".$datosAlerta['Texto']."',
							'".$datosAlerta['Tipo']."'
						);
					</script>";
			}
			elseif($datosAlerta['Alerta']==="recargar")
			{
				$alerta = "
					<script>
						swal({
							title: '".$datosAlerta['Titulo']."',
							text: '".$datosAlerta['Texto']."',
							type: '".$datosAlerta['Tipo']."',
							confirmButtonText: 'Aceptar'
						}).then(function() {
							location.reload();
						});
					</script>
				";
			}
			elseif($datosAlerta['Alerta']==="limpiar")
			{
				$alerta = "
					<script>
						swal({
							title: '".$datosAlerta['Titulo']."',
							text: '".$datosAlerta['Texto']."',
							type: '".$datosAlerta['Tipo']."',
							confirmButtonText: 'Aceptar'
						}).then(function() {
							$('.FormularioAjax')[0].reset();
						});
					</script>
				";
			}

			return $alerta;

		}
	}