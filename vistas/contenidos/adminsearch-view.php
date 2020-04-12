<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Usuarios <small>ADMINISTRADORES</small></h1>
	</div>
	<p class="lead">Busqueda de  un ADMINISTRADOR</p>
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

if (isset($_POST['busqueda_inicial_admin']))
{
	$_SESSION['busqueda_admin'] = $_POST['busqueda_inicial_admin'];
}

if (isset($_POST['eliminar_busqueda_admin'])) {
	unset($_SESSION['busqueda_admin']);
}

if(!isset($_SESSION['busqueda_admin']) && empty($_SESSION['busqueda_admin'])) :
	
?>

<div class="container-fluid">
	<form class="well" method="POST" action="">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<div class="form-group label-floating">
					<span class="control-label">¿Administrador que estas buscando?</span>
					<input class="form-control" type="text" name="busqueda_inicial_admin" required="" placeholder="DNI, Nombre o Apellidos" autocomplete="off">
				</div>
			</div>
			<div class="col-xs-12">
				<p class="text-center">
					<button type="submit" class="btn btn-primary btn-raised btn-lg"><i class="zmdi zmdi-search"></i> &nbsp; Buscar</button>
				</p>
			</div>
		</div>
	</form>
</div>

<?php

	else:

?>


<div class="container-fluid">
	<form class="well" method="POST" action="">
		<p class="lead text-center">Su última búsqueda  fue <strong>“<?php echo $_SESSION['busqueda_admin'] ?>”</strong></p>
		<div class="row">
			<input class="form-control" type="hidden" name="eliminar_busqueda_admin" value="1">
			<div class="col-xs-12">
				<p class="text-center">
					<button type="submit" class="btn btn-danger btn-raised btn-lg"><i class="zmdi zmdi-delete"></i> &nbsp; Eliminar búsqueda</button>
				</p>
			</div>
		</div>
	</form>
</div>


<!-- Panel listado de busqueda de administradores -->
<div class="container-fluid">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-search"></i> &nbsp; RESULTADO DE LA BÚSQUEDA</h3>
		</div>
		<div class="panel-body">

			<?php

				$pagina = explode("/", $_GET['views']);

				echo $instanciaAdministrador->paginarAdministradoresControlador($pagina[1], 1, $_SESSION['privilegio_sesion'], $_SESSION['codigo_cuenta_sesion'], $_SESSION['busqueda_admin']);
			?>

		</div>
	</div>
</div>
<?php
	endif;
?>