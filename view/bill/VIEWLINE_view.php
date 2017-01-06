<?php
echo '<div class="modal fade" id="view' . $p->getIdLinea() . '" tabindex="-1" role="dialog" aria-labelledby="' . $p->getIdLinea() . 'viewlabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="' . $p->getIdLinea() . 'label">' . $strings["bill_data"] . ': </h4>
            </div>
            <div class="modal-body">

            <div class="row">';
echo '<div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["concept"] . ': </label>
                        <span class="">' . $p->getConcepto() . '</span>

                    <!--Campo nombre-->
                </div>
              
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["price"] . ': </label>
                        <span class="">' . $p->getPrecio() . ' €</span>

                    <!--Campo cantidad-->
                </div>
                
                <div class="col-xs-12 col-md-12">
                        <label for="">IVA: </label>
                        <span class="">' . $p->getIva() . ' %</span>

                    <!--Campo cantidad-->
                </div>
                
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["units"] . ': </label>
                        <span class="">' . $p->getUnidades() . '</span>

                    <!--Campo cantidad-->
                </div>
                
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["total_quantity"] . ': </label>
                        <span class="">' . $p->getTotal() . ' €</span>

                    <!--Campo cantidad-->
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
