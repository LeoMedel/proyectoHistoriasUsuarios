<?php 
	class vistasModelo{
		protected function obtener_vistas_modelo($vistas){
			
			$listaBlancaVistas=[
				"adminlist",
				"adminsearch",
				"admin",
				"book",
				"bookconfig",
				"bookinfo",
				"catalog",
				"category",
				"categorylist",
				"client",
				"clientlist",
				"clientsearch",
				"company",
				"companylist",
				"home",
				"myaccount",
				"mydata",
				"provider",
				"providerlist",
				"search"
			];


			if(in_array($vistas, $listaBlancaVistas))
			{
				if(is_file("./vistas/contenidos/".$vistas."-view.php"))
				{
					$contenido="./vistas/contenidos/".$vistas."-view.php";
				}
				else
				{
					$contenido="login";
				}

			}
			elseif($vistas=="login")
			{
				$contenido="login";
			}
			elseif($vistas=="index")
			{
				$contenido="login";
			}else
			{
				$contenido="404";
			}

			return $contenido;
		}
	}