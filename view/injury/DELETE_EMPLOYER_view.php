<?php

echo '
            <div class="modal fade" id="confirmar' . $s->getCodEmpl() . '" tabindex="-1" role="dialog" aria-labelledby="' . $s->getCodEmpl() . 'label" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="' . $s->getCodEmpl() . 'label">' . $strings["confirm_msg"] . ' ' . $pls->getNameEmp($s->getCodEmpl()) . '?</h4>
                        </div>
                        <div class="modal-body">
                             <label for="">' . $strings["student_data"] . ': </label>';
//DATOS DO ALUMNO A BORRAR
echo '  
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["injury_name"] . ': </label>
                                    <span class="">' . $pls->getNameInjury($s->getCodInjury()) . '</span>
        
                                <!--Campo id_evento-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["employee"] . ': </label>
                                    <span class="">' . $pls->getNameEmp($s->getCodEmpl()) . '</span>
        
                                <!--Campo id_alumno-->
                           </div>
                          
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["date_injury"] . ': </label>
                                    <span class="">' . $s->getDateInjury() . '</span>
        
                                <!--Campo id_alumno-->
                           </div>
                           <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["date_recovery"] . ': </label>
                                    <span class="">' . $s->getDateRecovery() . '</span>
        
                                <!--Campo id_alumno-->
                           </div>
                           
                             <div id="collapse' . $s->getCodEmpl() . '" class="panel-collapse collapse" aria-expanded="true">
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
                            
                            <a href="index.php?controller=injury&action=deleteemployer&codpupil=' . $s->getCodEmpl() . '&id_lesion='.$s->getCodInjury().'">
                            <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                            </a>
                        </div>
                    </div></div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>';

?>