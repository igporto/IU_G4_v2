<?php

echo '
            <div class="modal fade" id="confirmar' . $p->getAlumn()->getCodalumn() . '" tabindex="-1" role="dialog" aria-labelledby="' . $p->getAlumn()->getCodalumn() . 'label" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="' . $p->getAlumn()->getCodalumn() . 'label">' . $strings["confirm_msg"] . ' ' . $p->getAlumn()->getAlumnname() . '?</h4>
                        </div>
                        <div class="modal-body">
                             <label for="">' . $strings["student_data"] . ': </label>';
//DATOS DO ALUMNO A BORRAR
echo '  
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["EVENTS_NAME"] . ': </label>
                                    <span class="">' . $p->getEvent()->getName() . '</span>
        
                                <!--Campo id_evento-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["student"] . ': </label>
                                    <span class="">' . $p->getAlumn()->getAlumnname() . '</span>
        
                                <!--Campo id_alumno-->
                           </div>
                           <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["dni"] . ': </label>
                                    <span class="">' . $p->getAlumn()->getDni() . '</span>
        
                                <!--Campo id_alumno-->
                           </div>
                             <div id="collapse' . $p->getAlumn()->getCodalumn() . '" class="panel-collapse collapse" aria-expanded="true">
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
                            
                            <a href="index.php?controller=event&action=deletepupil&codpupil=' . $p->getAlumn()->getCodalumn() . '&codevent='.$p->getEvent()->getCodevent().'">
                            <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>';

?>