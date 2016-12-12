 <?php include '../js/showscript.js.php'; ?>

<?php  echo "
<script type=\"text/javascript\">
$(document).ready(function() {
        $('#tabla_mostrar').DataTable({
            responsive: true,
            searching: true,
            ordering: true,
            paging: true,
            \"language\":<";
 ?>           
  
<?php 
switch ($_SESSION['idioma']) {
 	case 'SPANISH':
			 		echo "{
			    \"sProcessing\":     \"Procesando...\",
			    \"sLengthMenu\":     \"Mostrar _MENU_ registros\",
			    \"sZeroRecords\":    \"No se encontraron resultados\",
			    \"sEmptyTable\":     \"Ningún dato disponible en esta tabla\",
			    \"sInfo\":           \"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros\",
			    \"sInfoEmpty\":      \"Mostrando registros del 0 al 0 de un total de 0 registros\",
			    \"sInfoFiltered\":   \"(filtrado de un total de _MAX_ registros)\",
			    \"sInfoPostFix\":    \",
			    \"sSearch\":         \"Buscar:\",
			    \"sUrl\":            \",
			    \"sInfoThousands\":  \",\",
			    \"sLoadingRecords\": \"Cargando...\",
			    \"oPaginate\": {
			        \"sFirst\":    \"Primero\",
			        \"sLast\":     \"Último\",
			        \"sNext\":     \"Siguiente\",
			        \"sPrevious\": \"Anterior\"
			    },
			    \"oAria\": {
			        \"sSortAscending\":  \": Activar para ordenar la columna de manera ascendente\",
			        \"sSortDescending\": \": Activar para ordenar la columna de manera descendente\"
			    }
			}";
 		break;
 	case 'GALEGO':
				 				echo "{
				    \"sProcessing\":     \"Procesando...\",
				    \"sLengthMenu\":     \"Mostrar _MENU_ rexistros\",
				    \"sZeroRecords\":    \"Non se atoparon resultados\",
				    \"sEmptyTable\":     \"Ningún dato dispoñible nesta táboa\",
				    \"sInfo\":           \"Mostrando rexistros do _START_ ó _END_ dun total de _TOTAL_ rexistros\",
				    \"sInfoEmpty\":      \"Mostrando rexistros do 0 ó 0 dun total de 0 rexistros\",
				    \"sInfoFiltered\":   \"(filtrado dun total de _MAX_ rexistros)\",
				    \"sInfoPostFix\":    \",
				    \"sSearch\":         \"Buscar:\",
				    \"sUrl\":            \",
				    \"sInfoThousands\":  \",\",
				    \"sLoadingRecords\": \"Cargando...\",
				    \"oPaginate\": {
				        \"sFirst\":    \"Primeiro\",
				        \"sLast\":     \"Último\",
				        \"sNext\":     \"Seguinte\",
				        \"sPrevious\": \"Anterior\"
				    },
				    \"oAria\": {
				        \"sSortAscending\":  \": Activar para ordear a columna de maneira ascendente\",
				        \"sSortDescending\": \": Activar para ordear a columna de maneira descendente\"
				    }
				}";
 		break;
 	case 'ENGLISH':
					 		echo "{
					    \"sEmptyTable\":     \"No data available in table\",
					    \"sInfo\":           \"Showing _START_ to _END_ of _TOTAL_ entries\",
					    \"sInfoEmpty\":      \"Showing 0 to 0 of 0 entries\",
					    \"sInfoFiltered\":   \"(filtered from _MAX_ total entries)\",
					    \"sInfoPostFix\":    \",
					    \"sInfoThousands\":  \",\",
					    \"sLengthMenu\":     \"Show _MENU_ entries\",
					    \"sLoadingRecords\": \"Loading...\",
					    \"sProcessing\":     \"Processing...\",
					    \"sSearch\":         \"Search:\",
					    \"sZeroRecords\":    \"No matching records found\",
					    \"oPaginate\": {
					        \"sFirst\":    \"First\",
					        \"sLast\":     \"Last\",
					        \"sNext\":     \"Next\",
					        \"sPrevious\": \"Previous\"
					    },
					    \"oAria\": {
					        \"sSortAscending\":  \": activate to sort column ascending\",
					        \"sSortDescending\": \": activate to sort column descending\"
					    }
					}";
 		break;
 	
 } ?>





<?php 
echo "});
} );

</script>
"; ?>
        
