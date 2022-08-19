<div class="modal fade" id="show_products_modal" tabindex="-1" role="dialog" aria-labelledby="show_products_modal_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="show_products_modal"><?=$this->products["name"]?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="show_img">
                    <?=strlen($this->products["d_img"]) > 0 ? "<img src='".MAIN_PREFIX."/upload/{$this->products["d_img"]}' width='100px'/>": ""?>
                </div>
                <div class="show_description">
                    <p class="p1">Описание:</p>
                    <p class="p2"><?=$this->products["description"]?></p>
                </div>
                <div class="show_price">
                    <p class="p1">Рекомендованная цена:</p>
                    <p class="p2">от <?=$this->products["price"]?> тугриков</p>
                    <p><i>* указана рекомендованная цена для продажи. В зависимости от ретейлера цена может быть другой.</i></p>
                </div>
                
                <?$numbr = rand()?>
                <?if (count(json_decode($this->products["imgs"])) > 0):?>
                <p class="p1">Галерея дополнительных изображений</p>
                <div id="carouselExampleControls<?=$numbr?>" class="carousel carousel-dark slide" data-bs-ride="carousel" >
                    <!-- Обертка для слайдов -->
                    <div class="carousel-inner" >
                        <?
                        $imgs = json_decode($this->products["imgs"]);
                        $i = 0;
                        if (is_array($imgs) && count($imgs) > 0) {
                            foreach ($imgs as $img) {
                                if ($i == 0) {
                                   echo "<div class='carousel-item active'><img src='" . MAIN_PREFIX . "/upload/$img' class='d-block w-100'/></div>";
                                    $i = $i + 1; 
                                } else {
                                    echo "<div class='carousel-item'><img src='" . MAIN_PREFIX . "/upload/$img' class='d-block w-100'/></div>";
                                }

                            }
                        }
                        ?>
                    </div>

                    <!-- Элементы управления -->
                    <?if (count($imgs) > 1): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls<?=$numbr?>"  data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Предыдущий</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls<?=$numbr?>"  data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Следующий</span>
                    </button>
                    <?endif;?>
                </div>
                <?endif;?>
            </div>
        </div>
    </div>
</div>