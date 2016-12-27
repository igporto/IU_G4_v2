<?php 
 echo '
            <div class="modal fade" id="confirmar'.$c->getCodpermission().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getCodpermission().'label" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="'.$c->getCodpermission().'label">'.$strings["confirm_message"].' '.$c->getController()->getControllername()." -> ".$c->getAction()->getActionname().'?</h4>
                        </div>
                        <div class="modal-body">
                             <label for="">' . $strings["profile_data"] . ': </label>';
            //DATOS DO USUARIO A BORRAR
            echo '  
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["one_controller"] . ': </label>
                                    <span class="">' . $c->getController()->getControllername() . '</span>
        
                                <!--Campo nome do controllador-->
                            </div>
                          
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["one_action"] . ': </label>
                                    <span class="">' . $c->getAction()->getActionname() . '</span>
        
                                <!--Campo nome da accion-->
                            </div>
                            </div>
                            </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">'.$strings["cancel"].'</button> 
                            <a href="index.php?controller=permission&action=delete&perm_id=' . $c->getCodpermission().'">
                            <button type="button" class="btn btn-danger">'.$strings["DELETE"].'</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>';

 ?>