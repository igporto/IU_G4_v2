 <?php  
 echo '<div class="modal fade" id="view'.$p->getIdPago().'" tabindex="-1" role="dialog" aria-labelledby="'.$p->getIdPago().'viewlabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="'.$p->getIdPago().'label">' . $strings["payment_data"] . ': </h4>
            </div>
            <div class="modal-body">';

            //DATOS DO PAGO
 echo '  
            <div class="row">
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["id"] . ': </label>
                        <span class="">' . $p->getIdPago() . '</span>

                    <!--Campo id-->
                </div>
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["date"] . ': </label>
                        <span class="">' . $p->getFecha() . '</span>

                    <!--Campo fecha-->
                </div>
              
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["quantity"] . ': </label>
                        <span class="">' . $p->getCantidad() . ' €</span>

                    <!--Campo cantidad-->
                </div>
                
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["payment_method"] . ': </label>
                        <span class="">' . $p->getMetodoPago() . '</span>

                    <!--Campo metodo pago-->
                </div>
                
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["discount"] . ': </label>
                        <span class="">' . $p->getDescuento() . '</span>

                    <!--Campo descuento-->
                </div>
                
                <div class="col-xs-12 col-md-12">';

 if ($p->getDniAlum() != NULL) {
     echo '
                    <label for="">' . $strings["student"] . ': </label>
                        <span class="">' . $p->getDniAlum() . '</span>';
 } else {
     echo '            <label for="">' . $strings["external_client"] . ': </label>
                        <span class="">' . $p->getDniClienteExterno() . '</span>';
 }

 echo '
                    <!--Campo dni-->
                </div>
                </div></div><div class="modal-footer">
                
                <button type="button" class="btn btn-success" data-dismiss="modal">
                <i class="fa fa-tick"></i>'.$strings["okay"].'</button>
                
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>';

?>
