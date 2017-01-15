 <?php  
 echo '
                                    <div class="modal fade" id="view'.$c->getIdSession().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getIdSession().'viewlabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="'.$c->getIdSession().'label">' . $strings["action_data"] . ': </h4>
                                                                </div>
                                                                <div class="modal-body">';
                                                                //DATOS DO USUARIO
                                                               echo '  
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["name"] . ': </label>
                                                                            <span class="">' . $c->getActivity()->getActivityname() . '</span>
                                                                        <!--Campo ususario-->
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["date"] . ': </label>
                                                                            <span class="">' . $c->getDate() . '</span>
                                                                        <!--Campo ususario-->
                                                                    </div>
                                                                </div>
                                                                 <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["start_time"] . ': </label>
                                                                            <span class="">' . $c->getHourStart() . '</span>
                                                                        <!--Campo ususario-->
                                                                    </div>
                                                                </div>
                                                              <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["end_time"] . ': </label>
                                                                            <span class="">' . $c->getHourEnd() . '</span>
                                                                        <!--Campo ususario-->
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["space"] . ': </label>
                                                                            <span class="">' . $c->getSpace()->getSpacename() . '</span>
                                                                        <!--Campo ususario-->
                                                                    </div>
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
