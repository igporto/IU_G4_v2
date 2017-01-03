<?php
echo '
                                    <div class="modal fade" id="view'.$c->getCoddiscount().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getType().'viewlabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="'.$c->getCoddiscount().'label">' . $strings["category_data"] . ': </h4>
                                                                </div>
                                                                <div class="modal-body">';

//DATOS DO USUARIO A BORRAR
echo '  
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["discount_type"] . ': </label>
                                                                            <span class="">' . $c->getType() . '</span>
                                                                        <!--Campo type-->
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["discount"] . ': </label>
                                                                            <span class="">' . $c->getPercent() . '</span>
                                                                        <!--Campo percent-->
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["description"] . ': </label>
                                                                            <span class="">' . $c->getDescription() . '</span>
                                                                        <!--Campo descipcion-->
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
