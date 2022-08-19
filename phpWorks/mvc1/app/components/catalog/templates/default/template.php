
<h1>
    Каталог нашей продукции
</h1>

<div class="few_words">
    <p>
        Данный раздел посвящен нашей продукии. Здесь представлена вся актуальная продукция, производимая нашей компанией. По вопросам касающимся покупки стоит обращаться к ретейлерам.
    </p>
</div>

<div class="row main">
    <div class="col-2">
        <div class="catalog_menu">
            <?if (is_array($arResult["SECTIONS"])):?>
            <a class="sectiones" href="javascript:showProductsBySection('lol')">Категории</a>
            <ul>
                <?
                    foreach($arResult["SECTIONS"] as $sec){
                ?>
                    <li>
                        <a href="javascript:showProductsBySection(<?=$sec["id"]?>)">
                            <?=$sec["name"]?>
                        </a>
                    </li>
                <?
                }?>
            </ul>
            <?endif;?> 
        </div>
        
    </div>
    
    <div class="col-10 products_catalog">
        <?if (is_array($arResult["PRODUCTS"])):?>
        <div class="myContainer">
        <div class="row row-cols-3">
        <?
            foreach($arResult["PRODUCTS"] as $prod){
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
</div>

