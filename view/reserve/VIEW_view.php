<?php
echo '
                                <div class="modal fade" id="view'.$e->getCodReserve().'" tabindex="-1" role="dialog" aria-labelledby="'.$e->getCodReserve().'viewlabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="'.$e->getCodReserve().'label">'.$strings["reserve_data"].' '.$e->getCodReserve().':</h4>
                                            </div>
                                            <div class="modal-body">
                                                 <label for="">' . $strings["reserve"] . ': '.$e->getCodReserve().' </label>';
$mp = new ReserveMapper();
//DATOS DO EVENTO A AMOSAR
echo '  
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["code"] . ': </label>
                                                        <span class="">' . $e->getCodReserve() . '</span>

                                                </div>

                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["space"] . ': </label>
                                                        <span class="">' . $mp->getNameSpace($e->getSpace()) . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["service"] . ': </label>
                                                        <span class="">' . $mp->getNameService($e->getService()) . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["alumn"] . ': </label>
                                                        <span class="">' . $mp->getAlumnname($e->getAlumn()) . '</span>

                                                </div>    

                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["date"] . ': </label>
                                                        <span class="">' . $e->getDate() . '</span>

                                                </div>                                            
                                                <div class="col-xs-12 col-md-12">
                                                         <label for="">' . $strings["startTime"] . ': </label>
                                                        <span class="">' . $e->getStartTime() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["endTime"] . ': </label>
                                                        <span class="">' . $e->getEndTime() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                         <label for="">' . $strings["place_price"] . ': </label>
                                                        <span class="">' . $e->getSpacePrice() . '</span>

                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["physio_price"] . ': </label>
                                                        <span class="">' . $e->getPhysioPrice() . '</span>

                                                </div>
                                                            
                                                            <div id="collapsev' . $e->getCodReserve() . '" class="panel-collapse collapse" aria-expanded="true">
                                                            <div class="panel-body">
                                                    <ul>';



echo '</ul>
                        
                                        
                                </div>

                                                </div>
                                                </div>

                                            </div>';

//fin dos datos da reserva
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
