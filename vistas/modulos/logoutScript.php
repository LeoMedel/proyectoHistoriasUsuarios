<script>
	$(document).ready(function(){
		$('.btn-exit-system').on('click', function(e){
        	e.preventDefault();

        	var Token = $(this).attr('href');

        	swal({
            	title: 'Cerrar Sesión',
            	text: "La sesión esta apunto de ser cerrada. ¿Desea salir?",
            	type: 'warning',
            	showCancelButton: true,
            	confirmButtonColor: '#4AB150',
            	cancelButtonColor: '#F44336',
            	confirmButtonText: 'Salir <i class="zmdi zmdi-run"></i>',
            	cancelButtonText: 'Cancelar <i class="zmdi zmdi-close-circle"></i>'
        	}).then(function () {
            	$.ajax({
            		url:'<?php echo SERVERURL;?>ajax/loginAjax.php?Token='+Token,
            		success: function(data){

            			if (data=="true")
            			{
            				window.location.href = "<?php echo SERVERURL;?>login/";
            			}
            			else if(data=="token")
            			{
            				swal(
            					"Error al salir",
            					"Error con el token",
            					"error"
            				);
            			}
                        else if(data=="usuario")
                        {
                            swal(
                                "Error al salir",
                                "Error con el usuario",
                                "error"
                            );
                        }
                        else if(data=="false")
                        {
                            swal(
                                "Error al salir",
                                "Error al salir. Problemas tecnicos",
                                "error"
                            );
                        }
                        else
                        {
                            swal(
                                "Error al salir",
                                "Error con el modelo: "+data,
                                "error"
                            );
                        }

            		}
            	});
        	});
    	});
	});
</script>



