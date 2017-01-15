<?php
echo '
    <div class="modal fade" id="view'. $c->getCodRegistration(). '" tabindex="-1" role="dialog" aria-labelledby="'. $c->getCodRegistration() .'viewlabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="'.$c->getCodRegistration().'label">' . $strings["registration_data"] . ' </h4>
                </div>
            <div class="modal-body">';
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
        
        <div class="col-xs-12 col-md-12">
                <label for="">' . $strings["periodad_de_pago"] . ': </label>
                <span class="">' . $c->getPeriodicidad() . '</span>
            <!--Campo date-->
        </div>
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