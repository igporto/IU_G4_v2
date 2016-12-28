<?php 
echo '
                                <div class="modal fade" id="view'.$c->getUsername().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getUsername().'viewlabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="'.$c->getCoduser().'label">'.$strings["user_data"].' '.$c->getUsername().':</h4>
                                            </div>
                                            <div class="modal-body">
                                                 <label for="">' . $strings["code"] . ': '.$c->getCoduser().' </label>';
                                //DATOS DO USUARIO A BORRAR
                                echo '  
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["name"] . ': </label>
                                                        <span class="">' . $c->getUsername() . '</span>

                                                </div>
                                                 <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["profile_type"] . ': </label>
                                                        <span class="">' . $c->getProfile()->getProfilename() . '</span>
                                                   
                                                </div>
                            
                                                <div class="col-xs-12 col-md-6 col-md-offset-3">
                                                    <div class="panel panel-info">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsev' . $c->getCoduser() . '" aria-expanded="true" class="">'.$strings["user_perms"].': </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapsev' . $c->getCoduser() . '" class="panel-collapse collapse" aria-expanded="true">
                                                            <div class="panel-body">
                                                    <ul>';

                                $cermissions = $c->getPermissions()->getUserPermissions();

                                if ($c->getUsername() == 'admin') {
                                    echo $strings["user_has_all_permissions"];
                                }else{
                                    if($cermissions != NULL){
                                    //foreach que imprime o nome do controlador e da acción según os permisos que ten o perfil
                                    foreach ($cermissions as $cerm){
                                        echo '<li><span class=\"\">'.$cerm->getController()->getControllername().'</span><i class="fa fa-long-arrow-right fa-fw"></i>';
                                        echo '<span class=\"\">'.$cerm->getAction()->getActionname().'</span></li>';
                                    }
                                }
                                else{
                                    echo $strings['no_user_permissions'];
                                }
                                }

                                
                                echo '</ul>
                        
                                        </div>
                                    </div>
                                </div>

                                                </div>
                                                </div>

                                            </div>';

                                //fin dos datos do usuario
                                echo '
                                            

                                            <div class="modal-footer">
                                                
                                                <button type="button" class="btn btn-default" data-dismiss="modal">'.$strings["okay"].'</button>
                                                
                                                
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>';
 ?>

