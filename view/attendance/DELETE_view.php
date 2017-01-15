<?php
echo '
                                    <div class="modal fade" id="confirmar' . $c->getCod() . '" tabindex="-1" role="dialog" aria-labelledby="' . $c->getCod() . 'label" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="' . $c->getCod() . 'label">' . $strings["confirm_message"] . ' ' . $c->getCod() . '?</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                     <label for="">' . $strings["attendance_data"] . ': </label>';
//DATOS DO USUARIO A BORRAR
$session = $c->getSession();
echo '  
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["alumn"] . ': </label>
                                                                            <span class="">' . $c->getAlumn()->getCodalumn() . '</span>

                                                                        <!--Campo ususario-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["session"] . ': </label>
                                                                            <span class="">' . $session->getActivity()->getActivityname()." ".$session->getDate() . " -> ".$session->getHourstart()."-".$session->getHourend() . '</span>
                                                                        <!--Campo ususario-->
                                                                    </div>
                                                                    
                                                                </div>
                                                                </div><div class="modal-footer">
                                                                    
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>
                                                                    
                                                                    <a href="index.php?controller=category&action=delete&codcategory=' . $c->getCodcategory() . '">
                                                                    <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>';

?>