 <?php  
 echo '<div class="modal fade" id="view'.$c->getDni().'" tabindex="-1" role="dialog" aria-labelledby="'.$c->getDni().'viewlabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="'.$c->getDni().'label">' . $strings["client_data"] . ': </h4>
            </div>
            <div class="modal-body">';

            //DATOS DO CLIENTE
           echo '  
            <div class="row">
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["name"] . ': </label>
                        <span class="">' . $c->getName() . '</span>
            
                 <!--Campo nome-->
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["surname"] . ': </label>
                        <span class="">' . $c->getSurname() . '</span>
            
                 <!--Campo apellido-->
                </div>
            </div>
            
            <div class="row">
                <label for="">' . $strings["dni"] . ': </label>
                            <span class="">' . $c->getDni() . '</span>
                            
                <!--Campo dni-->
            </div>
            
            <div class="row">
                <label for="">' . $strings["phone"] . ': </label>
                            <span class="">' . $c->getPhone() . '</span>
                            
                <!--Campo phone-->
            </div>
            
            <div class="row">
                <label for="">' . $strings["email"] . ': </label>
                            <span class="">' . $c->getEmail() . '</span>
                            
                <!--Campo email-->
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
