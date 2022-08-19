
<div class="col-10 products_catalog">
        <?if (is_array($this->products)):?>
        <div class="myContainer">
        <div class="row row-cols-3">
        <?
            foreach($this->products as $prod){
                if ($prod["active"] == "1") {
        ?>
            <div class="col"> 
                <a href="javascript:getShowFormByID(<?=$prod["id"]?>)">
                    <div class="product_item_content">
                        <div class="product_img">
                            <?=strlen($prod["p_img"]) > 0 ? "<img src='".MAIN_PREFIX."/upload/{$prod["p_img"]}' width='100px'/>": ""?>
                        </div>
                        <div class="product_name">
                            <?=$prod["name"]?>
                        </div>
                        <div class="product_price">
                            <p>
                                от <?=$prod["price"]?> тугриков
                            </p>
                        </div>
                    </div>
                </a>
                
            </div>   
        <?
                }
                }?>
            </div>
            </div>
        <?endif;?>
    </div>