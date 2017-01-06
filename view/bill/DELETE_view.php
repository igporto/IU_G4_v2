<?php
echo '
                                    <div class="modal fade" id="confirmar' . $p->getIdFactura() . '" tabindex="-1" role="dialog" aria-labelledby="' . $p->getNombre() . 'label" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="' . $p->getIdFactura() . 'label">' . $strings["confirm_message"] . ' ' . $p->getNombre() . '?</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                     <label for="">' . $strings["bill_data"] . ': </label>';
//DATOS DO USUARIO A BORRAR
echo '  
                                                                 <div class="row">';
echo '<div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["bill_number"] . ': </label>
                        <span class="">' . $p->getNumero() . '</span>

                    <!--Campo nombre-->
                </div>
              
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["name"] . ': </label>
                        <span class="">' . $p->getNombre() . ' </span>

                    <!--Campo cantidad-->
                </div>
                
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["date"] . ': </label>
                        <span class="">' . $p->getFecha() . ' </span>

                    <!--Campo cantidad-->
                </div>
                </div></div>
                
                <div class="modal-footer">
                                                                    
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>
                                                                    
                                                                    <a href="index.php?controller=bill&action=delete&id_factura=' . $p->getIdFactura() . '">
                                                                    <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>';

?>