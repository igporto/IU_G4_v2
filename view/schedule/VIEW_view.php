 <?php  
 echo '
                                    <div class="modal fade" id="view'.$c->getSchedulename().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getSchedulename().'viewlabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="'.$c->getSchedulename().'label">' . $strings["action_data"] . ': </h4>
                                                                </div>
                                                                <div class="modal-body">';
                                                                     
                                                                //DATOS DO USUARIO A BORRAR
                                                               echo '  
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["name"] . ': </label>
                                                                            <span class="">' . $c->getSchedulename() . '</span>
                                                                
                                                                            
                                                                        <!--Campo ususario-->
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <label for="">' . $strings["code"] . ': </label>
                                                                                <span class="">' . $c->getIdSchedule() . '</span>
                                                                </div>

                                                                <div class="row">
                                                                    <label for="">' . $strings["datestart"] . ': </label>
                                                                                <span class="">' . $c->getDateStart() . '</span>
                                                                </div>

                                                                <div class="row">
                                                                    <label for="">' . $strings["dateend"] . ': </label>
                                                                                <span class="">' . $c->getDateEnd() . '</span>
                                                                </div>

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
