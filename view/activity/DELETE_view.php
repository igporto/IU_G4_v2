<?php
echo '
                                    <div class="modal fade" id="confirmar' . $c->getCodactivity() . '" tabindex="-1" role="dialog" aria-labelledby="' . $c->getActivityname() . 'label" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="' . $c->getCodactivity() . 'label">' . $strings["confirm_message"] . ' ' . $c->getActivityname() . '?</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                     <label for="">' . $strings["activity_data"] . ': </label>';
//DATOS DO USUARIO A BORRAR
echo '  
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["name"] . ': </label>
                                                                            <span class="">' . $c->getActivityname() . '</span>

                                                                        <!--Campo name-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["aforo"] . ': </label>
                                                                            <span class="">' . $c->getCapacity() . '</span>

                                                                        <!--Campo aforo-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["one_category"] . ': </label>
                                                                            <span class="">' . $c->getCategory()->getCategoryname() . '</span>

                                                                        <!--Campo categoria-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["one_space"] . ': </label>
                                                                            <span class="">' . $c->getSpace()->getSpacename() . '</span>

                                                                        <!--Campo espazo-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["discount"] . ': </label>
                                                                            <span class="">' . $c->getDiscount()->getPercent() . '% </span>

                                                                        <!--Campo desconto-->
                                                                    </div>
                                                                   
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["monitor"] . ': </label>
                                                                            <span class="">' . $c->getEmployee()->getEmployeename().' </span>

                                                                        <!--Campo empleado-->
                                                                    </div>
                                                                    </div></div><div class="modal-footer">
                                                                    
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>
                                                                    
                                                                    <a href="index.php?controller=activity&action=delete&codactivity=' . $c->getCodactivity() . '">
                                                                    <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>';

?>