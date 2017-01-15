<?php
require_once(__DIR__ . "/../../model/DOMICILIATION_model.php");
$dm = new DomiciliationMapper();

$c = $dm->view($_GET['coddomiciliation']);
//echo '<iframe size="90%" src="'. $c->getRoute() .'"> </iframe>';d


echo '<iframe   class="text-center" src="'.$c->getDocumento().' " width="800px" height="800px"></iframe>
      ';
