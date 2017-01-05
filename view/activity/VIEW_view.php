<?php
echo '
                                    <div class="modal fade" id="view'. $c->getCodactivity(). '" tabindex="-1" role="dialog" aria-labelledby="'. $c->getActivityname() .'viewlabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="'.$c->getCodactivity().'label">' . $strings["activity_data"] . ': </h4>
                                                                </div>
                                                                <div class="modal-body">';

//DATOS DO USUARIO A BORRAR
echo '  
                                                                <div class="row">
                                                                    <label for="">' . $strings["code"] . ': </label>
                                                                    <span class="">' . $c->getCodactivity() . '</span>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["name"] . ': </label>
                                                                            <span class="">' . $c->getActivityname() . '</span>                                                                
                                                                        <!--Campo name-->
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["aforo"] . ': </label>
                                                                            <span class="">' . $c->getCapacity() . '</span>                                                                
                                                                        <!--Campo aforo-->
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["one_category"] . ': </label>
                                                                            <span class="">' . $c->getCategory()->getCategoryname() . '</span>                                                                
                                                                        <!--Campo categoria-->
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["one_space"] . ': </label>
                                                                            <span class="">' . $c->getSpace()->getSpacename() . '</span>                                                                
                                                                        <!--Campo espazo-->
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["discount"] . ': </label>
                                                                            <span class="">' .$c->getDiscount()->getType()." -> ". $c->getDiscount()->getPercent() . '%</span>                                                                
                                                                        <!--Campo desconto-->
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["monitor"] . ': </label>
                                                                            <span class="">' . $c->getEmployee()->getEmployeename() . '</span>                                                                
                                                                        <!--Campo aforo-->
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-md-12">
                                                                        <label for="">' . $strings["price"] . ': </label>
                                                                        <span class="">' . $c->getPrice() . '€ </span>
                                                                    <!--Campo desconto-->
                                                                </div>                                                           
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12">
                                                                            <label for="">' . $strings["color"] . ': </label>
                                                                            <span class="">' . $c->getColor() .'</span>                                                                                                                                 
                                                                        <!--Campo aforo-->
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
