<?php
echo '<div class="modal fade" id="confirmar' . $p->getIdPago() . '" tabindex="-1" role="dialog" aria-labelledby="' . $p->getIdPago() . 'label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="' . $p->getDniAlum() . 'label">' . $strings["confirm_message"] . ' ' . $p->getDniAlum() . '?</h4>
            </div>
            <div class="modal-body">
                 <label for="">' . $strings["payment_data"] . ': </label>

<div class="row">';
//DATOS DO PAGO A BORRAR
if ($p->getDniAlum() != NULL) {
    echo '
                    <label for="">' . $strings["student"] . ': </label>
                        <span class="">' . $p->getDniAlum() . '</span>';
} else {
    echo '            <label for="">' . $strings["external_client"] . ': </label>
                        <span class="">' . $p->getDniClienteExterno() . '</span>';
}

echo '<div class="col-xs-12 col-md-12">
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
                        <label for="">' . $strings["pagado"] . ': </label>
                        <span class="">';
if ($p->getPagado() == 1) {
    echo $strings["si"];
} else {
    echo $strings["no"];
}
echo '</span>

                    <!--Campo pagado-->
                </div>';
if ($p->getPagado() == 1) {
    echo '<div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["payment_method"] . ': </label>
                        <span class="">' . $p->getMetodoPago() . '</span>

                    <!--Campo metodo pago-->
                </div>';
}
echo '               <div class="col-xs-12 col-md-12">';

echo '
                    <!--Campo dni-->
                </div>
                </div></div>
                
                <div class="modal-footer">
                
                <button type="button" class="btn btn-success" data-dismiss="modal">
                <i class="fa fa-tick"></i>' . $strings["okay"] . '</button>
                
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>';
?>