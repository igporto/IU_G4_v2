<?php
echo '
<div class="modal fade" id="view'. $i->getCod(). '" tabindex="-1" role="dialog" aria-labelledby="'. $i->getCod() .'viewlabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="'.$i->getEmployee()->getCodemployee().'label">' . $strings["injury_data"] . ' </h4>
            </div>
            <div class="modal-body">';

echo '  
                                 <div class="row">
                                     <div class="col-xs-12 col-md-12">
                                             <label for="">' . $strings["injury_name"] . ': </label>
                                             <span class="">' . $i->getInjury()->getNameInjury() . '</span>
                            
                                         <!--Campo id_evento-->
                                     </div>
                                     <div class="col-xs-12 col-md-12">
                                             <label for="">' . $strings["employee"] . ': </label>
                                             <span class="">' . $i->getEmployee()->getEmployeename(). '</span>
                            
                                         <!--Campo id_alumno-->
                                    </div>
                                   
                                     <div class="col-xs-12 col-md-12">
                                             <label for="">' . $strings["date_injury"] . ': </label>
                                             <span class="">' . $i->getDateInjury() . '</span>
                            
                                         <!--Campo id_alumno-->
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                             <label for="">' . $strings["date_recovery"] . ': </label>
                                             <span class="">' . $i->getDateRecovery() . '</span>
                            
                                         <!--Campo id_alumno-->
                                    </div>
                                    
                                      <div id="collapse' . $i->getCod() . '" class="panel-collapse collapse" aria-expanded="true">
                                          <div class="panel-body">
                                         <ul>                                                                                                                             
                </div><div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">
                    <i class="fa fa-tick"></i>'.$strings["okay"].'</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>';

?>

