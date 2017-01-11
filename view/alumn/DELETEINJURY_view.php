<?php

echo '
             <div class="modal fade" id="confirmar' . $i->getCod() . '" tabindex="-1" role="dialog" aria-labelledby="' . $i->getCod() . 'label" aria-hidden="true" style="display: none;">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                             <h4 class="modal-title" id="' . $i->getCod() . 'label">' . $strings["confirm_message"] . ' '. $strings['injury'] .': '. $i->getInjury()->getNameInjury() . '?</h4>
                         </div>
                         <div class="modal-body">
                            <label for="">' . $strings["injury_data"] . ' </label>';

echo '  
                                 <div class="row">
                                     <div class="col-xs-12 col-md-12">
                                             <label for="">' . $strings["injury_name"] . ': </label>
                                             <span class="">' . $i->getInjury()->getNameInjury() . '</span>
                            
                                         <!--Campo id_evento-->
                                     </div>
                                     <div class="col-xs-12 col-md-12">
                                             <label for="">' . $strings["alumn"] . ': </label>
                                             <span class="">' . $i->getPupil()->getAlumnname(). '</span>
                            
                                         <!--Campo id_alumno-->
                                    </div>
                                   
                                     <div class="col-xs-12 col-md-12">
                                             <label for="">' . $strings["date_injury"] . ': </label>
                                             <span class="">' . $i->getDate() . '</span>
                            
                                         <!--Campo id_alumno-->
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                             <label for="">' . $strings["date_recovery"] . ': </label>
                                             <span class="">' . $i->getDateRecovery() . '</span>
                            
                                         <!--Campo id_alumno-->
                                    </div>
                                    
                                      <div id="collapse' . $i->getCod() . '" class="panel-collapse collapse" aria-expanded="true">
                                          <div class="panel-body">
                                         <ul>';

echo '</ul>
                                     
                                                     
                                     </div>
                            
                                    </div>
                                
                                </div>
                             </div>
                             <div class="modal-footer">
                                 
                                 <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>
                                    <a href="index.php?controller=alumn&action=deleteinjury&codinjuryalumn=' . $i->getCod() . '">
                                             <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                                     </a>
                                
                             </div>
                         </div></div>
                         <!- /.modal-content -->
                     </div>
                     <!- /.modal-dialog -->
                 </div>';
