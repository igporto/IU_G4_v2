<?php
echo '
                                <div class="modal fade" id="view'.$c->getCodInjury().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getNameInjury().'viewlabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="'.$c->getCodInjury().'label">'.$strings["injury_data"].' '.$c->getNameInjury().':</h4>
                                            </div>
                                            <div class="modal-body">
                                                 <label for="">' . $strings["injury_id"] . ': '.$c->getCodInjury().' </label>';
//DATOS DA LESION A AMOSAR
echo '  
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["name"] . ': </label>
                                                        <span class="">' . $c->getNameInjury() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["description"] . ': </label>
                                                        <span class="">' . $c->getDescription() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["treatment"] . ': </label>
                                                        <span class="">' . $c->getTreatment() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["time_recovery"] . ': </label>
                                                        <span class="">' . $c->getTime() . '</span>

                                                </div>
                                                            
                                                            <div id="collapsev' . $c->getCodInjury() . '" class="panel-collapse collapse" aria-expanded="true">
                                                            <div class="panel-body">
                                                    <ul>';



echo '</ul>
                        
                                        
                                </div>

                                                </div>
                                                </div>

                                            </div>';

//fin dos datos do espazo
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

