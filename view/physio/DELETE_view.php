<?php
echo '
    <div class="modal fade" id="confirmar' . $c->getCodPhysio() . '" tabindex="-1" role="dialog" aria-labelledby="' . $c->getCodPhysio() . 'label" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="' . $c->getCodPhysio() . 'label">' . $strings["confirm_message"] . ' ' . $c->getCodPhysio() . '?</h4>
                    </div>
                <div class="modal-body">
         <label for="">' . $strings["physio_data"] . ': </label>';
//DATOS DO USUARIO A BORRAR
echo '
    <div class="row">
        <div class="col-xs-12 col-md-12">
                <label for="">' . $strings["one_reserve"] . ': </label>
                <span class="">' . $c->getReserve()->getCodReserve() . '</span>
            <!--Campo reserve-->
        </div>
        <div class="col-xs-12 col-md-12">
                <label for="">' . $strings["date"] . ': </label>
                <span class="">' . $c->getDate() . '</span>
            <!--Campo date-->
        </div>
        <div class="col-xs-12 col-md-12">
                <label for="">' . $strings["startTime"] . ': </label>
                <span class="">' . $c->getStartTime() . '</span>
            <!--Campo startTime-->
        </div>
        <div class="col-xs-12 col-md-12">
                <label for="">' . $strings["endTime"] . ': </label>
                <span class="">' . $c->getEndTime() . '</span>
            <!--Campo endTime-->
        </div>
        </div></div><div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>
        
        <a href="index.php?controller=physio&action=delete&codrRegistration=' . $c->getCodPhysio() . '">
        <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
        </a>
    </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>';
?>