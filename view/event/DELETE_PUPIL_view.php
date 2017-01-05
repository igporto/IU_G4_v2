<?php

echo '
            <div class="modal fade" id="confirmar' . $s->getCodStudent() . '" tabindex="-1" role="dialog" aria-labelledby="' . $s->getCodStudent() . 'label" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="' . $s->getCodStudent() . 'label">' . $strings["confirm_msg"] . ' ' . $pls->getNamePupil($s->getCodStudent()) . '?</h4>
                        </div>
                        <div class="modal-body">
                             <label for="">' . $strings["student_data"] . ': </label>';
//DATOS DO ALUMNO A BORRAR
echo '  
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["EVENTS_NAME"] . ': </label>
                                    <span class="">' . $pls->getNameEvent($s->getCodEvent()) . '</span>
        
                                <!--Campo id_evento-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["student"] . ': </label>
                                    <span class="">' . $pls->getNamePupil($s->getCodStudent()) . '</span>
        
                                <!--Campo id_alumno-->
                           </div>
                           <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["dni"] . ': </label>
                                    <span class="">' . $pls->getDniId($s->getCodStudent()) . '</span>
        
                                <!--Campo id_alumno-->
                           </div>
                             <div id="collapse' . $s->getCodStudent() . '" class="panel-collapse collapse" aria-expanded="true">
                                 <div class="panel-body">
                                <ul>';

echo '</ul>
    
                    
            </div>

                            </div>

                        </div>';

//fin dos datos do alumno
echo '
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>
                            
                            <a href="index.php?controller=event&action=deletepupil&codpupil=' . $s->getCodStudent() . '&id_evento='.$s->getCodEvent().'">
                            <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>';

?>