<?php
echo '<div class="modal fade" id="view' . $p->getIdDomiciliacion() . '" tabindex="-1" role="dialog" aria-labelledby="' . $p->getIdDomiciliacion() . 'viewlabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="' . $p->getIdDomiciliacion() . 'label">' . $strings["domiciliation_data"] . ': </h4>
            </div>
            <div class="modal-body">';

//DATOS DO PAGO
echo '  
            <div class="row">
                       <div class="col-xs-12 col-md-12" >
                        <label for="" > ' . $strings["client"] . ': </label >
                        <span class="" > ' . $p->getIdCliente() . '</span >

                    <!--Campo id cliente-->
                </div >
                
                <div class="col-xs-12 col-md-12">
                        <label for="">' . $strings["period"] . ': </label>
                        <span class="">' . $p->getPeriodo() . ' ' . $strings["period"] . '</span >

                    <!--Campo periodo-->
                </div >
              
                <div class="col-xs-12 col-md-12" >
                        <label for="" > ' . $strings["total_quantity"] . ': </label >
                        <span class="" > ' . $p->getTotal() . ' €</span >

                    <!--Campo total-->
                </div >
                
         
                
                <div class="col-xs-12 col-md-12" >
                        <label for="" > IBAN: </label >
                        <span class="" > ' . $p->getIban() . '</span >

                    <!--Campo iban-->
                </div >
                <div class="col-xs-12 col-md-12" >
                        <label for="" >'.$strings['document'].' </label >';

                        echo "<a href=index.php?controller=domiciliation&action=viewdoc&coddomiciliation=" . $p->getIdDomiciliacion() . '>';
                        echo "<button class='btn btn-primary btn-xs ";
                        echo "' style='margin:2px'>";
                        echo "<i class='fa fa-eye fa-fw'></i></button></a>";
echo '                        
                    <!--Campo iban-->
                </div >
                </div ></div ><div class="modal-footer" >
                
                <button type = "button" class="btn btn-success" data-dismiss = "modal" >
                <i class="fa fa-tick" ></i > ' . $strings["okay"] . '</button >
                
            </div >
        </div >
        <!-- /.modal - content-->
    </div >
    <!-- /.modal - dialog-->
</div > ';

?>
