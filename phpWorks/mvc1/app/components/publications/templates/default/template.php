
<h1>
    Новости
</h1>

<div class="few_words">
    <p></p>
</div>

<div class="row main">
    <div class="col-2">
        <div class="publications_menu">
            <?if (is_array($arResult["CATEGORIES"])):?>
            <a class="categorys" href="javascript:showNewsByCategory('lol')">Категории</a>
            <ul>
                <?
                    foreach($arResult["CATEGORIES"] as $cat){
                ?>
                    <li>
                        <a href="javascript:showNewsByCategory(<?=$cat["id"]?>)">
                            <?=$cat["name"]?>
                        </a>
                    </li>
                <?
                }?>
            </ul>
            <?endif;?> 
        </div>
        
    </div>
    
    <div class="col-10 news_publications">
        <?if (is_array($arResult["NEWS"])):?>
        <div class="myContainer">
            <div class="row">
            <?
                foreach($arResult["NEWS"] as $news){?>
                    <div class="news_content"> 
                        <a href="<?=MAIN_PREFIX?>/news/?<?=$news["id"]?>">
                            <div class="news_item_content">
                                <div class="news_title">
                                    <?= $news["title"] ?>
                                </div>
                                <div class="row">
                                    <div class="news_img col-2">
                                        <?= strlen($news["p_img"]) > 0 ? "<img src='" . MAIN_PREFIX . "/upload/{$news["p_img"]}' width='100px'/>" : "" ?>
                                    </div>
                                    <div class="news_description col-8">
                                        <p>
                                            <?= $news["description"] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="news_date">
                                    <p>
                                        <?= substr($news["date"],0,-9) ?>
                                    </p>
                                </div>

                            </div>
                        </a>

                    </div>
                <?}?>
                </div>
            </div>
        <?endif;?>
    </div>
</div>

