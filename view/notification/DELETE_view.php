<?php
echo '
                                    <div class="modal fade" id="confirmar'.$c->getCodnotification().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getCodnotification().'label" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="'.$c->getCodnotification().'label">'.$strings["confirm_message"].' '.$c->getCodnotification().'?</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                     <label for="">' . $strings["notification_data"] . ' </label>';
//DATOS DO USUARIO A BORRAR
echo '  
                                                                
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["code"] . ': </label>
                                                                            <span class="">' . $c->getCodnotification() . '</span>
                                                                        <!--Campo ususario-->
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <label for="">' . $strings["description"] . ': </label>
                                                                                <span class="">' . $c->getDescription() . '</span>
                                                                </div>
                                                                <div class="row">
                                                                    <label for="">' . $strings["one_user"] . ': </label>
                                                                                <span class="">' . $c->getUser()->getUsername() . '</span>
                                                                </div>
                                                                
                                                                </div><div class="modal-footer">
                                                                    
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">'.$strings["cancel"].'</button>
                                                                    
                                                                    <a href="index.php?controller=notification&action=delete&codnotification=' . $c->getCodnotification().'">
                                                                    <button type="button" class="btn btn-danger">'.$strings["DELETE"].'</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>';

?>