<?php
require_once(__DIR__ . "/../../model/DOCUMENT_model.php");
$dm = new DocumentMapper();

$c = $dm->view($_GET['coddocument']);
//echo '<iframe size="90%" src="'. $c->getRoute() .'"> </iframe>';d


echo '<iframe   class="text-center" src="'.$c->getRoute().' " width="800px" height="800px"></iframe>
      ';