 <?php  
 echo '<div class="modal fade" id="confirmar'.$c->getDni().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getDni().'label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="'.$c->getDni().'label">'.$strings["confirm_message"].' '.$c->getDni().'?</h4>
            </div>
            <div class="modal-body">
                 <label for="">' . $strings["client_data"] . ': </label>';
            //DATOS DO CLIENTE A BORRAR
           echo '  
            <div class="row">
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["dni"] . ': </label>
                        <span class="">' . $c->getDni() . '</span>

                    <!--Campo dni-->
                </div>
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["name"] . ': </label>
                        <span class="">' . $c->getName(). '</span>

                    <!--Campo nombre-->
                </div>
              
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["surname"] . ': </label>
                        <span class="">' . $c->getSurname() . '</span>

                    <!--Campo apellido-->
                </div>
                
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["phone"] . ': </label>
                        <span class="">' . $c->getPhone() . '</span>

                    <!--Campo phone-->
                </div>
                
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["email"] . ': </label>
                        <span class="">' . $c->getEmail() . '</span>

                    <!--Campo email-->
                </div>
                
                </div></div><div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">'.$strings["cancel"].'</button>
                
                <a href="index.php?controller=client&action=delete&clientdni=' . $c->getDni().'">
                <button type="button" class="btn btn-danger">'.$strings["DELETE"].'</button>
                </a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>';

?>