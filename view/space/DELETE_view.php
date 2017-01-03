<?php
echo '
            <div class="modal fade" id="confirmar' . $c->getCodspace() . '" tabindex="-1" role="dialog" aria-labelledby="' . $c->getSpacename() . 'label" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="' . $c->getCodspace() . 'label">' . $strings["confirm_message"] . ' ' . $c->getSpacename() . '?</h4>
                        </div>
                        <div class="modal-body">
                             <label for="">' . $strings["spaces_data"] . ': </label>';
//DATOS DO ESPAZO A BORRAR
echo '  
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["space_id"] . ': </label>
                                    <span class="">' . $c->getCodspace() . '</span>
        
                                <!--Campo id-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["name"] . ': </label>
                                    <span class="">' . $c->getSpacename() . '</span>
        
                                <!--Campo name-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["aforo"] . ': </label>
                                    <span class="">' . $c->getCapacity() . '</span>
        
                                <!--Campo name-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["description"] . ': </label>
                                    <span class="">' . $c->getDescription() . '</span>
        
                                <!--Campo name-->
                            </div>
        
        
                            
                                       
                             <div id="collapse' . $c->getCodspace() . '" class="panel-collapse collapse" aria-expanded="true">
                                 <div class="panel-body">
                                <ul>';

echo '</ul>
    
                    
            </div>

                            </div>

                        </div>';

//fin dos datos do espazo
echo '
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>
                            
                            <a href="index.php?controller=space&action=delete&id_espacio=' . $c->getCodspace() . '">
                            <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>';

?>