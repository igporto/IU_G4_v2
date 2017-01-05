<?php
echo '
                                <div class="modal fade" id="view'.$e->getEventname().'" tabindex="-1" role="dialog" aria-labelledby="'.$e->getEventname().'viewlabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="'.$e->getCodEvent().'label">'.$strings["spaces_data"].' '.$e->getEventname().':</h4>
                                            </div>
                                            <div class="modal-body">
                                                 <label for="">' . $strings["event_id"] . ': '.$e->getCodEvent().' </label>';
//DATOS DO EVENTO A AMOSAR
echo '  
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["name"] . ': </label>
                                                        <span class="">' . $e->getEventname() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["initial_hour"] . ': </label>
                                                        <span class="">' . $e->getInitialHour() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["final_hour"] . ': </label>
                                                        <span class="">' . $e->getFinalHour() . '</span>

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
                                                        <label for="">' . $strings["space_id"] . ': </label>
                                                        <span class="">' . $e->getCodSpace() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["dni_p"] . ': </label>
                                                        <span class="">' . $e->getCodProf() . '</span>

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
                                                
                                                <button type="button" class="btn btn-default" data-dismiss="modal">'.$strings["okay"].'</button>
                                                
                                                
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>';
?>
