<?php
echo '
                                <div class="modal fade" id="view'.$e->getCodevent().'" tabindex="-1" role="dialog" aria-labelledby="'.$e->getName().'viewlabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="'.$e->getCodevent().'label">'.$strings["event_data"].' '.$e->getName().':</h4>
                                            </div>
                                            <div class="modal-body">';

//DATOS DO EVENTO A AMOSAR
echo '  
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["name"] . ': </label>
                                                        <span class="">' . $e->getName() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["initial_hour"] . ': </label>
                                                        <span class="">' . $e->getIniHour() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["final_hour"] . ': </label>
                                                        <span class="">' . $e->getFinHour() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["date"] . ': </label>
                                                        <span class="">' . $e->getDate() . '</span>

                                                </div>
                                                 <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["aforo"] . ': </label>
                                                        <span class="">' . $e->getCapacity() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["space_name"] . ': </label>
                                                        <span class="">' . $e->getSpace()->getSpacename() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["dni_p"] . ': </label>
                                                        <span class="">' . $e->getEmployee()->getEmployeename() . '</span>

                                                </div>
                                                            
                                                            <div id="collapsev' . $e->getCodEvent() . '" class="panel-collapse collapse" aria-expanded="true">
                                                            <div class="panel-body">
                                                    <ul>';



echo '</ul>
                        
                                        
                                </div>

                                                </div>
                                                </div>

                                            </div>';

//fin dos datos do evento
echo '
                                            

                                            <div class="modal-footer">
                                                
                                                <button type="button" class="btn btn-success" data-dismiss="modal">'.$strings["okay"].'</button>
                                                
                                                
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>';
?>
