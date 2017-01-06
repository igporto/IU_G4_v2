<?php
require_once(__DIR__."/../../model/DOCUMENT_model.php");
echo '
                                    <div class="modal fade" id="view'. $c->getCodalumn(). '" tabindex="-1" role="dialog" aria-labelledby="'. $c->getAlumnname() .'viewlabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="'.$c->getCodalumn().'label">' . $strings["employee_data"] . ': </h4>
                                                                </div>
                                                                <div class="modal-body">';

//DATOS DO USUARIO A BORRAR
echo '  
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["name"] . ': </label>
                                                                            <span class="">' . $c->getAlumnname() . '</span>

                                                                        <!--Campo name-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["surname"] . ': </label>
                                                                            <span class="">' . $c->getAlumnsurname() . '</span>

                                                                        <!--Campo apelidos-->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["dni"] . ': </label>
                                                                            <span class="">' . $c->getDni() . '</span>

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
                                                                            <label for="">' . $strings["job"] . ': </label>
                                                                            <span class="">' . $c->getJob() . ' </span>

                                                                        <!--Campo job-->
                                                                    </div>                                                                  
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["pengingclasses"] . ': </label>
                                                                            <span class="">' . $c->getPendingclasses() . ' </span>

                                                                        <!--Campo -->
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-6 col-md-offset-3">
                                                                        <div class="panel panel-info">
                                                                            <div class="panel-heading">
                                                                                <h4 class="panel-title">
                                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsev' . $c->getCodAlumn() . '" aria-expanded="true" class="">'.$strings["DOCUMENT"].': </a>
                                                                                </h4>
                                                                            </div>
                                                                            <div id="collapsev' . $c->getCodAlumn() . '" class="panel-collapse collapse" aria-expanded="true">
                                                                                <div class="panel-body">
                                                                                    <ul>';

                                                                                    $dm = new DocumentMapper();
                                                                                    $docs = $dm->showdocsAlumn($c->getCodAlumn());

                                                                                    if ($docs == NULL) {
                                                                                        echo $strings['no_documents'];
                                                                                    }else{
                                                                                        foreach ($docs as $doc){
                                                                                            echo '<li>';
                                                                                            echo "<a href=index.php?controller=document&action=view&coddocument=" . $doc->getCoddocument() . '>';
                                                                                            echo "<button class='btn btn-primary btn-xs ";
                                                                                            echo "' style='margin:2px'>";
                                                                                            echo "<i class='fa fa-eye fa-fw'></i></button></a>";
                                                                                            echo '<span class="">'.$doc->getName().'</span></li>';
                                                                                        }
                                                                                    }
                                                                            echo '</ul>
                                                                            </div>
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

