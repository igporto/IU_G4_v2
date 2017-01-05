<?php
echo '
            <div class="modal fade" id="confirmar' . $c->getCodInjury() . '" tabindex="-1" role="dialog" aria-labelledby="' . $c->getNameInjury() . 'label" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="' . $c->getCodInjury() . 'label">' . $strings["confirm_message"] . ' ' . $c->getNameInjury() . '?</h4>
                        </div>
                        <div class="modal-body">
                             <label for="">' . $strings["injury_data"] . ': </label>';
//DATOS DO ESPAZO A BORRAR
echo '
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["injury_id"] . ': </label>
                                    <span class="">' . $c->getCodInjury() . '</span>

                                <!--Campo id-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["name"] . ': </label>
                                    <span class="">' . $c->getNameInjury() . '</span>

                                <!--Campo name-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["treatment"] . ': </label>
                                    <span class="">' . $c->getTreatment() . '</span>

                                <!--Campo name-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["description"] . ': </label>
                                    <span class="">' . $c->getDescription() . '</span>

                                <!--Campo name-->
                            </div>
                            <div class="col-xs-12 col-md-12">
                                     <label for="">' . $strings["time_recovery"] . ': </label>
                                     <span class="">' . $c->getTime() . '</span>

                                <!--Campo name-->
                            </div>




                             <div id="collapse' . $c->getCodInjury() . '" class="panel-collapse collapse" aria-expanded="true">
                                 <div class="panel-body">
                                <ul>';

echo '</ul>


            </div>

                            </div>

                        </div>';

//fin dos datos do espazo
echo '
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>

                            <a href="index.php?controller=injury&action=delete&id_lesion=' . $c->getCodInjury() . '">
                            <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>';

?>