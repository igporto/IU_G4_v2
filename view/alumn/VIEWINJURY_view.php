<?php
echo '
<div class="modal fade" id="view'. $i->getCod(). '" tabindex="-1" role="dialog" aria-labelledby="'. $i->getCod() .'viewlabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="'.$i->getPupil()->getCodalumn().'label">' . $strings["injury_data"] . ' </h4>
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
                                             <label for="">' . $strings["alumn"] . ': </label>
                                             <span class="">' . $i->getPupil()->getAlumnname(). '</span>
                            
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
                                    
                                                                                                                                                                  
                </div>
                <div class="modal-footer">
                <a href=index.php?controller=alumn&action=viewinjury&codinjuryalumn='. $i->getCod() .' >
                    <button type="button" class="btn btn-success">
                    <i class="fa fa-tick"></i>'.$strings["okay"].'</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>';

?>

