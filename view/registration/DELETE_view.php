<?php
echo ' 
    <div class="modal fade" id="confirmar' . $c->getCodRegistration() . '" tabindex="-1" role="dialog" aria-labelledby="' . $c->getCodRegistration() . 'label" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="' . $c->getCodRegistration() . 'label">' . $strings["confirm_message"] . ' ' . $c->getCodRegistration() . '?</h4>
                    </div>
                <div class="modal-body">
         <label for="">' . $strings["registration_data"] . ': </label>';
//DATOS DO USUARIO A BORRAR
echo '
    <div class="row">
        <div class="col-xs-12 col-md-12">
                <label for="">' . $strings["code"] . ': </label>
                <span class="">' . $c->getCodRegistration() . '</span>
            <!--Campo date-->
        </div>
        <div class="col-xs-12 col-md-12">
                <label for="">' . $strings["activity"] . ': </label>';
                if($c->getActivity()->getCodactivity() != NULL){
                    echo '<span class="">' . $c->getActivity()->getCodactivity() . '</span>';
                }else{
                    echo '<span class="">' . $strings['without_activity'] . '</span>';
                }
                echo '
            <!--Campo reserve-->
        </div>
        <div class="col-xs-12 col-md-12">
                <label for="">' . $strings["event"] . ': </label>';
                if($c->getEvent()->getCodevent() != NULL){
                    echo '<span class="">' . $c->getEvent()->getCodevent() . '</span>';
                }else {
                    echo '<span class="">' . $strings['without_event'] . '</span>';
                }
                echo '
            <!--Campo reserve-->
        </div>
        <div class="col-xs-12 col-md-12">
                <label for="">' . $strings["alumn"] . ': </label>
                <span class="">' . $c->getAlumn()->getCodalumn() . '</span>
            <!--Campo date-->
        </div>
        <div class="col-xs-12 col-md-12">
                <label for="">' . $strings["date"] . ': </label>
                <span class="">' . $c->getDate() . '</span>
            <!--Campo date-->
        </div>
        <div class="col-xs-12 col-md-12">
                <label for="">' . $strings["payment"] . ': </label>';
                if($c->getPayment()->getIdPago() != NULL){
                    echo '<span class="">' . $c->getPayment()->getIdPago() . '</span>';
                }else {
                    echo '<span class="">' . $strings['without_payment'] . '</span>';
                }
                echo '
            <!--Campo reserve-->
        </div>
        </div></div><div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">' . $strings["cancel"] . '</button>
        
        <a href="index.php?controller=registration&action=delete&codRegistration=' . $c->getCodRegistration() . '">
        <button type="button" class="btn btn-danger">' . $strings["DELETE"] . '</button>
        </a>
    </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>';
?>