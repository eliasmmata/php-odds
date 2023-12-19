<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">            
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=$infoPage['name']?></h5>                                                                                                  
                    <spam class="badge badge-primary">P-<?=$infoPage['permissions_level']?></spam>                                    
            </div>
            <div class="modal-body">
                <div>                                          
                    <p><?=$infoPage['description']?></p>                                                                                                                            
                </div>
                <div class="row">
                    <?php if (isset($infoPage['info']) && !empty($infoPage['info'])) { ?>                        
                        <div class="col-<?php if (isset($infoPage['action']) && !empty($infoPage['action'])) {echo '6';}else{ echo '12';}?>">
                            <div class="card h-100">
                                <div class="card-header border border-primary bg-primary rounded">
                                Info:
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <?php foreach($infoPage['info'] as $items) {?>
                                                                            
                                                <li class="p-1">
                                                    <spam class="badge badge-<?php if(isset($items['color']) && !empty($items['color'])){echo $items['color'];}else{echo 'light';}?>"><?=$items['key']?></spam><?php if (isset($items['text']) && !empty($items['text'])) {echo ' => '.$items['text'];}?>
                                                </li>
                                                    
                                        <?php }?>
                                    </ul>  
                                </div>
                            </div>                                                        
                        </div>  
                    <?php } ?>
                    <?php if (isset($infoPage['action']) && !empty($infoPage['action'])) { ?>
                        <div class="col-<?php if (isset($infoPage['info']) && !empty($infoPage['info'])) {echo '6';}else{ echo '12';}?>">
                            <div class="card h-100">
                                <div class="card-header border border-warning bg-warning rounded">
                                Actions:
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <?php foreach($infoPage['action'] as $items) {?>
                                                                            
                                                <li class="p-1">
                                                    <spam class="badge badge-<?php if(isset($items['color']) && !empty($items['color'])){echo $items['color'];}else{echo 'light';}?>"><?=$items['key']?></spam><?php if (isset($items['text']) && !empty($items['text'])) {echo ' => '.$items['text'];}?>
                                                </li>
                                                    
                                        <?php }?>
                                    </ul>  
                                </div>
                            </div>                            
                        </div> 
                    <?php } ?> 
                </div>
            </div>        
        </div>
    </div>
</div>