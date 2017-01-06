<?php
echo '<div class="modal fade" id="view' . $p->getIdFactura() . '" tabindex="-1" role="dialog" aria-labelledby="' . $p->getIdFactura() . 'viewlabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="' . $p->getIdFactura() . 'label">' . $strings["bill_data"] . ': </h4>
            </div>
            <div class="modal-body">

            <div class="row">';
echo '<div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["bill_number"] . ': </label>
                        <span class="">' . $p->getNumero() . '</span>

                    <!--Campo nombre-->
                </div>
              
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["name"] . ': </label>
                        <span class="">' . $p->getNombre() . '</span>

                    <!--Campo cantidad-->
                </div>
                
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["date"] . ': </label>
                        <span class="">' . $p->getFecha() . '</span>

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
