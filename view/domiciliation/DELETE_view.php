<?php
echo '<div class="modal fade" id="confirmar' . $p->getIdDomiciliacion() . '" tabindex="-1" role="dialog" aria-labelledby="' . $p->getIdDomiciliacion() . 'label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="' . $p->getIdDomiciliacion() . 'label">' . $strings["confirm_message"] . ' ' . $p->getIdDomiciliacion() . '?</h4>
            </div>
            <div class="modal-body">
                 <label for="">' . $strings["domiciliation_data"] . ': </label>';
//DATOS DO PAGO A BORRAR
echo '  
            <div class="row">
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["id"] . ': </label>
                        <span class="">' . $p->getIdDomiciliacion() . '</span>

                    <!--Campo id-->
                </div>
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["period"] . ': </label>
                        <span class="">' . $p->getPeriodo() . '</span>

                    <!--Campo fecha-->
                </div>
              
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["total_quantity"] . ': </label>
                        <span class="">' . $p->getTotal() . '</span>

                    <!--Campo cantidad-->
                </div>
                
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["client"] . ': </label>
                        <span class="">' . $p->getIdCliente() . '</span>

                    <!--Campo metodo domiciliacion-->
                </div>
                
                <div class="col-xs-12 col-md-12">
                        <label for="">IBAN: </label>
                        <span class="">' . $p->getIban() . '</span>

                    <!--Campo descuento-->
                </div>

                </div></div><div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>
                
                <a href="index.php?controller=domiciliation&action=delete&id_domiciliacion=' . $p->getIdDomiciliacion() . '">
                <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
                </a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>';

?>