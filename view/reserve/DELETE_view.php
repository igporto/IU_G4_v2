<?php
echo '
            <div class="modal fade" id="confirmar' . $e->getCodReserve() . '" tabindex="-1" role="dialog" aria-labelledby="' . $e->getCodReserve() . 'label" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="' . $e->getCodReserve() . 'label">' . $strings["confirm_message"] . ' ' . $e->getCodReserve() . '?</h4>
                        </div>
                        <div class="modal-body">
                             <label for="">' . $strings["reserve_data"] . ': </label>';
//DATOS da reserva A BORRAR
echo '
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["reserve"] . ': </label>
                                    <span class="">' . $e->getCodReserve() . '</span>

                                <!--Campo id-->
                            </div>
                            
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["space_name"] . ': </label>
                                    <span class="">' . $e->getSpace()->getSpacename() . '</span>

                                <!--Campo id espacio-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["service"] . ': </label>
                                    <span class="">' . $e->getService()->getId() . '</span>

                                <!--Campo id espacio-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["alumn"] . ': </label>
                                    <span class="">' . $e->getAlumn()->getAlumnname()." ". $e->getAlumn()->getAlumnsurname() . '</span>

                                <!--Campo id espacio-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["date"] . ': </label>
                                    <span class="">' . $e->getDate() . '</span>

                                <!--Campo fecha-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["startTime"] . ': </label>
                                    <span class="">' . $e->getStartTime() . '</span>

                                <!--Campo hora inicial-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["endTime"] . ': </label>
                                    <span class="">' . $e->getEndTime() . '</span>

                                <!--Campo hora fin-->
                            </div>
                            
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["place_price"] . ': </label>
                                    <span class="">' . $e->getSpacePrice() . '€</span>

                                <!--Campo space_price-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["physio_price"] . ': </label>
                                    <span class="">' . $e->getPhysioPrice() . '€</span>

                                <!--Campo space_price-->
                            </div>



                             <div id="collapse' . $e->getCodReserve() . '" class="panel-collapse collapse" aria-expanded="true">
                                 <div class="panel-body">
                                <ul>';

echo '</ul>


            </div>

                            </div>

                        </div>';

//fin dos datos do reserva
echo '
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>

                            <a href="index.php?controller=reserve&action=delete&codReserve=' . $e->getCodReserve() . '">
                            <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>';

?>