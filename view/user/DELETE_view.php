 <?php 
 echo '
            <div class="modal fade" id="confirmar'.$c->getUsername().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getUsername().'label" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="'.$c->getUsername().'label">'.$strings["confirm_message"].' '.$c->getUsername().'?</h4>
                        </div>
                        <div class="modal-body">
                             <label for="">' . $strings["user_data"] . ': </label>';
                        //DATOS DO USUARIO A BORRAR
                       echo '  
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                    <label for="">' . $strings["name"] . ': </label>
                                    <span class="">' . $c->getUsername() . '</span>
        
                                <!--Campo ususario-->
                            </div>
        
                            <div class="col-xs-12 col-md-12">
                                    <label for="">'.$strings["profile_type"].': </label>
                                    <span class="">'.$c->getProfile()->getProfilename().'</span>
                                <!--Campo perfil-->
                            </div>
        
                            <div class="col-xs-12 col-md-6 col-md-offset-3">
                                <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse' . $c->getUsername() . '" aria-expanded="true" class="">'.$strings["own_permis"].': </a>
                                            </h4>
                                        </div>
                                        <div id="collapse' . $c->getUsername() . '" class="panel-collapse collapse" aria-expanded="true">
                                            <div class="panel-body">
                                <ul>';
                                        
                                $permissions = $c->getPermissions()->getUserPermissions();
                                
                                if($permissions != NULL){
                                    //foreach que imprime o nome do controlador e da acción según os permisos que ten o usuario
                                    foreach ($permissions as $p){
                                       echo '<li><span class=\"\">'.$p->getController()->getControllername().'</span><i class="fa fa-long-arrow-right fa-fw"></i>';
                                       echo '<span class=\"\">'.$p->getAction()->getActionname().'</span></li>';
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
                            
                            <a href="index.php?controller=user&action=delete&user=' . $c->getUsername().'">
                            <button type="button" class="btn btn-danger">'.$strings["DELETE"].'</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>';

 ?>