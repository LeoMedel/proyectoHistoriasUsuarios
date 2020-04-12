
<?php
    if ($_SESSION['tipo_sesion'] != "Administrador") {
        //echo $loginControl->forzarCierreSesion();
        echo $loginControl->redireccionarUsuarioControlador($_SESSION['tipo_sesion']);
    }
?>

<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles">REGISTROS <small>Administrador, Docentes y Estudiantes</small></h1>
	</div>
</div>
<div class="full-box text-center" style="padding: 30px 10px;">
	

    <?php
        require "./controladores/administradorControlador.php";
        $administradorControl = new administradorControlador();

        $conteoAdmin = $administradorControl->mostrarInfoAdministradoresControlador("conteo", 0)
    ?>


    <article class="full-box tile">
        <a href="<?php echo SERVERURL; ?>adminlist/">
            <div class="full-box tile-title text-center text-titles text-uppercase">
                ADMINISTRADORES
            </div>
            <div class="full-box tile-icon text-center">
                <i class="zmdi zmdi-laptop"></i>
            </div>
            <div class="full-box tile-number text-titles">
                <p class="full-box"> <?php echo $conteoAdmin->rowCount(); ?> </p>
                <small>Registros</small>
            </div>
        </a>
	</article>

	<article class="full-box tile">
		<div class="full-box tile-title text-center text-titles text-uppercase">
			DOCENTES
		</div>
		<div class="full-box tile-icon text-center">
			<i class="zmdi zmdi-accounts-alt"></i>
		</div>
		<div class="full-box tile-number text-titles">
			<p class="full-box">X</p>
			<small>Registros</small>
		</div>
	</article>

	<article class="full-box tile">
		<div class="full-box tile-title text-center text-titles text-uppercase">
			ESTUDIANTES
		</div>
		<div class="full-box tile-icon text-center">
			<i class="zmdi zmdi-male-female"></i>
		</div>
		<div class="full-box tile-number text-titles">
			<p class="full-box">X</p>
			<small>Registros</small>
		</div>
	</article>

</div>
<!--div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles">System <small>TimeLine</small></h1>
	</div>
	<section id="cd-timeline" class="cd-container">
        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL; ?>vistas/assets/avatars/Male1Avatar.png" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">1 - Name (Admin)</h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Start: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> End: <em>7:17 AM</em>
                </p>
                <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2016</span>
            </div>
        </div>  
        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL; ?>vistas/assets/avatars/Male1Avatar.png" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">2 - Name (Teacher)</h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Start: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> End: <em>7:17 AM</em>
                </p>
                <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2016</span>
            </div>
        </div>
        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL; ?>vistas/assets/avatars/Male1Avatar.png" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">3 - Name (Student)</h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Start: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> End: <em>7:17 AM</em>
                </p>
                <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2016</span>
            </div>
        </div>
        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL; ?>vistas/assets/avatars/Male1Avatar.png" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">4 - Name (Personal Ad.)</h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Start: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> End: <em>7:17 AM</em>
                </p>
                <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2016</span>
            </div>
        </div>   
    </section>
</div-->