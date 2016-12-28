 <?php  
 echo '
                                    <div class="modal fade" id="view'.$c->getActionname().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getActionname().'viewlabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="'.$c->getActionname().'label">' . $strings["action_data"] . ': </h4>
                                                                </div>
                                                                <div class="modal-body">';
                                                                     
                                                                //DATOS DO USUARIO A BORRAR
                                                               echo '  
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["name"] . ': </label>
                                                                            <span class="">' . $c->getActionname() . '</span>
                                                                
                                                                            
                                                                        <!--Campo ususario-->
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <label for="">' . $strings["code"] . ': </label>
                                                                                <span class="">' . $c->getCodaction() . '</span>
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
