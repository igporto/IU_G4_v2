<?php 
echo '
                                <div class="modal fade" id="confirmar'.$p->getCodprofile().'" tabindex="-1" role="dialog" aria-labelledby="'.$p->getCodprofile().'label" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="'.$p->getCodprofile().'label">'.$strings["confirm_message"].' '.$p->getProfilename().'?</h4>
                                            </div>
                                            <div class="modal-body">
                                                 <label for="">' . $strings["profile_data"] . ': </label>';
                                //DATOS DO USUARIO A BORRAR
                                echo '  
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12">
                                                        <label for="">' . $strings["name"] . ': </label>
                                                        <span class="">' . $p->getProfilename() . '</span>
                            
                                                    <!--Campo nome do perfil-->
                                                </div>
                            
                                                <div class="col-xs-12 col-md-6 col-md-offset-3">
                                                    <div class="panel panel-info">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse' . $p->getCodprofile() . '" aria-expanded="true" class="">'.$strings["profile_perms"].': </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse' . $p->getCodprofile() . '" class="panel-collapse collapse" aria-expanded="true">
                                                                <div class="panel-body">
                                                    <ul>';

                                $permissions = $p->getPermissions();

                                if($permissions != NULL){
                                    //foreach que imprime o nome do controlador e da acción según os permisos que ten o perfil
                                    foreach ($permissions as $perm){
                                        echo '<li><span class=\"\">'.$perm->getController()->getControllername().'</span><i class="fa fa-long-arrow-right fa-fw"></i>';
                                        echo '<span class=\"\">'.$perm->getAction()->getActionname().'</span></li>';
                                    }
                                }
                                else{
                                    echo $strings['no_user_permissions'];
                                }
                                echo '</ul>
                        
                                        </div>
                                    </div>
                                </div>

                                                </div>

                                            </div>';

                                //fin dos datos do usuario
                                echo '
                                            </div>
                                            <div class="modal-footer">
                                                
                                                <button type="button" class="btn btn-default" data-dismiss="modal">'.$strings["cancel"].'</button>
                                                
                                                <a href="index.php?controller=profile&action=delete&profile_id=' . $p->getCodprofile().'">
                                                <button type="button" class="btn btn-danger">'.$strings["DELETE"].'</button>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>';
 ?>