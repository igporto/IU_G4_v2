<?php
echo '
                                <div class="modal fade" id="view'.$c->getCodspace().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getSpacename().'viewlabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="'.$c->getCodspace().'label">'.$strings["spaces_data"].' '.$c->getSpacename().':</h4>
                                            </div>
                                            <div class="modal-body">
                                                 <label for="">' . $strings["space_id"] . ': '.$c->getCodspace().' </label>';
//DATOS DO ESPAZO A AMOSAR
echo '  
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["name"] . ': </label>
                                                        <span class="">' . $c->getSpacename() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["description"] . ': </label>
                                                        <span class="">' . $c->getDescription() . '</span>

                                                </div>
                                                 <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["aforo"] . ': </label>
                                                        <span class="">' . $c->getCapacity() . '</span>

                                                </div>
                                                            
                                                            <div id="collapsev' . $c->getCodspace() . '" class="panel-collapse collapse" aria-expanded="true">
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

