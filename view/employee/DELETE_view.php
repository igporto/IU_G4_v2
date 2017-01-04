<?php
echo '
                                    <div class="modal fade" id="confirmar' . $c->getCodemployee() . '" tabindex="-1" role="dialog" aria-labelledby="' . $c->getEmployeename() . 'label" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="' . $c->getCodemployee() . 'label">' . $strings["confirm_message"] . ' ' . $c->getEmployeename() . '?</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                     <label for="">' . $strings["employee_data"] . ': </label>';
//DATOS DO USUARIO A BORRAR
echo '  
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["name"] . ': </label>
                                                                            <span class="">' . $c->getEmployeename() . '</span>

                                                                        <!--Campo name-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["surname"] . ': </label>
                                                                            <span class="">' . $c->getEmployeesurname() . '</span>

                                                                        <!--Campo apelidos-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["dni"] . ': </label>
                                                                            <span class="">' . $c->getEmployeedni() . '</span>

                                                                        <!--Campo dni-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["birthdate"] . ': </label>
                                                                            <span class="">' . $c->getBirthdate() . '</span>

                                                                        <!--Campo fech_nac-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["address"] . ': </label>
                                                                            <span class="">' . $c->getAddress() . '</span>

                                                                        <!--Campo direccion-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["email"] . ': </label>
                                                                            <span class="">' . $c->getEmail() . ' </span>

                                                                        <!--Campo email-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["hour_in"] . ': </label>
                                                                            <span class="">' . $c->getHourIn() . ' </span>

                                                                        <!--Campo horain-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["hour_out"] . ': </label>
                                                                            <span class="">' . $c->getHourOut() . ' </span>

                                                                        <!--Campo horaout-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["bank_account"] . ': </label>
                                                                            <span class="">' . $c->getBanknum() . ' </span>

                                                                        <!--Campo bancaria-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["contract_type"] . ': </label>
                                                                            <span class="">' . $c->getContracttype() . ' </span>

                                                                        <!--Campo contrato-->
                                                                    </div>
                                                                   
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["employee_user"] . ': </label>
                                                                            <span class="">' . $c->getUser()->getUsername().' </span>

                                                                        <!--Campo empleado-->
                                                                    </div>
                                                                    </div></div><div class="modal-footer">
                                                                    
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>
                                                                    
                                                                    <a href="index.php?controller=employee&action=delete&codemployee=' . $c->getCodemployee() . '">
                                                                    <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>';

?>