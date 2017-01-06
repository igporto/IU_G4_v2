<?php
echo '
                                    <div class="modal fade" id="view'. $c->getCodemployee(). '" tabindex="-1" role="dialog" aria-labelledby="'. $c->getEmployeename() .'viewlabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="'.$c->getCodemployee().'label">' . $strings["employee_data"] . ': </h4>
                                                                </div>
                                                                <div class="modal-body">';

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
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["personal_comment"] . ': </label>
                                                                            <span class="">' . $c->getComment().' </span>

                                                                        <!--Campo commentario-->
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

