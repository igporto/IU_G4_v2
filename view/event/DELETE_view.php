<?php
echo '
            <div class="modal fade" id="confirmar' . $e->getEventname() . '" tabindex="-1" role="dialog" aria-labelledby="' . $e->getEventname() . 'label" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="' . $e->getCodEvent() . 'label">' . $strings["confirm_message"] . ' ' . $e->getEventname() . '?</h4>
                        </div>
                        <div class="modal-body">
                             <label for="">' . $strings["event_data"] . ': </label>';
//DATOS DO EVENTO A BORRAR
echo '
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["event_id"] . ': </label>
                                    <span class="">' . $e->getCodEvent() . '</span>

                                <!--Campo id-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["name"] . ': </label>
                                    <span class="">' . $e->getEventname() . '</span>

                                <!--Campo name-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["aforo"] . ': </label>
                                    <span class="">' . $e->getCapacity() . '</span>

                                <!--Campo aforo-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["space_id"] . ': </label>
                                    <span class="">' . $e->getCodSpace() . '</span>

                                <!--Campo id espacio-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["initial_hour"] . ': </label>
                                    <span class="">' . $e->getInitialHour() . '</span>

                                <!--Campo hora inicial-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["final_hour"] . ': </label>
                                    <span class="">' . $e->getFinalHour() . '</span>

                                <!--Campo hora fin-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["date"] . ': </label>
                                    <span class="">' . $e->getDate() . '</span>

                                <!--Campo fecha-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["dni_p"] . ': </label>
                                    <span class="">' . $e->getCodProf() . '</span>

                                <!--Campo id_prof-->
                            </div>



                             <div id="collapse' . $e->getCodEvent() . '" class="panel-collapse collapse" aria-expanded="true">
                                 <div class="panel-body">
                                <ul>';

echo '</ul>


            </div>

                            </div>

                        </div>';

//fin dos datos do evento
echo '
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>

                            <a href="index.php?controller=event&action=delete&id_evento=' . $e->getCodEvent() . '">
                            <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>';

?>