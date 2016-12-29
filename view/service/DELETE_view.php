<?php
echo '<div class="modal fade" id="confirmar'.$c->getId().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getId().'label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="'.$c->getId().'label">'.$strings["confirm_message"].' '.$c->getId().'?</h4>
            </div>
            <div class="modal-body">
                 <label for="">' . $strings["service_data"] . ': </label>';
//DATOS DO SERVIZO A BORRAR
echo '  
            <div class="row">
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["date"] . ': </label>
                        <span class="">' . $c->getFecha() . '</span>

                    <!--Campo date-->
                </div>
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["cost"] . ': </label>
                        <span class="">' . $c->getCoste(). '</span>

                    <!--Campo cost-->
                </div>
              
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["description"] . ': </label>
                        <span class="">' . $c->getDescripcion() . '</span>

                    <!--Campo description-->
                </div>
                
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["dni"] . ': </label>
                        <span class="">' . $c->getDniClienteExterno() . '</span>

                    <!--Campo dni-->
                </div>
     
                
                </div></div><div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">'.$strings["cancel"].'</button>
                
                <a href="index.php?controller=service&action=delete&service_id=' . $c->getId().'">
                <button type="button" class="btn btn-danger">'.$strings["DELETE"].'</button>
                </a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>';

?>