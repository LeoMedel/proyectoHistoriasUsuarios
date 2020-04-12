
<?php
	if ($_SESSION['tipo_sesion'] != "Administrador") {
		echo $loginControl->forzarCierreSesion();
	}
?>

<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Usuarios <small>ADMINISTRADORES</small></h1>
	</div>
	<p class="lead">Listado de los ADMINISTRADORES registrados en el sistema</p>
</div>

<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
		<li>
	  		<a href="<?php echo SERVERURL; ?>adminlist/" class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE ADMINISTRADORES
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL; ?>admin/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO ADMINISTRADOR
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL; ?>adminsearch/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR ADMINISTRADOR
	  		</a>
	  	</li>
	</ul>
</div>

<?php

	require_once "./controladores/administradorControlador.php";

	$instanciaAdministrador = new administradorControlador();

?>

<!-- Panel listado de administradores -->
<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp;ADMINISTRADORES</h3>
		</div>
		<div class="panel-body">

			<?php

				$pagina = explode("/", $_GET['views']);

				echo $instanciaAdministrador->paginarAdministradoresControlador($pagina[1], 5, $_SESSION['privilegio_sesion'], $_SESSION['codigo_cuenta_sesion'], "");
			?>

		</div>
	</div>
</div>