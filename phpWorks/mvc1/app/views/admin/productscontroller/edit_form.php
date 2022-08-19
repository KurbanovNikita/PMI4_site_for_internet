<div class="modal fade" id="edit_products_modal" tabindex="-1" role="dialog" aria-labelledby="edit_products_modal_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_products_modal">Редактирование категории</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger error_danger" style="display: none;" role="alert">
                    Произошла ошибка!
                </div>
                <div class="mx-auto">
                    <form id="form_edit_products" name="form_edit_products" method="post" action="<?= ADMIN_PREFIX ?>/products/edit/">
                        <input type="hidden" value="<?=$this->products["id"]?>" name="id"/>
                        <div>
                            Изменяем ID = <span class="edit_id"><?=$this->products["id"]?></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="product_name">Название товара</label>
                            <input type="text" required class="form-control" name="product_name" id="product_name" placeholder="" value="<?=$this->products["name"]?>">
                        </div>
                        <div class="form-group">
                            <label for="product_code">Код товара</label>
                            <input type="text" required class="form-control" name="product_code" id="product_code" placeholder="" value="<?=$this->products["code"]?>">
                        </div>
                        <div class="form-group">
                            <label for="parent_section">Категория</label>
                            <select class="form-control" name="parent_section" id="parent_section" value="<?=$sect_name?>">
                                <option value="0" data-depth-level='-1'>.</option>
                                <?
                                foreach ($this->all_sections as $section) {
                                    echo '<option value="' . $section["id"] . '" '.($section['id'] == $this->products["sections_id"] ? "selected" : "").' data-depth-level="' . $section["depth_level"] . '">' . $section["name"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_price">Цена</label>
                            <input type="text" required class="form-control" name="product_price" id="product_price" placeholder="" value="<?=$this->products["price"]?>">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="product_active" type="checkbox" <?=($this->products["active"] == "1")? 'checked' : "" ?>> Активный
                            </label>
                        </div>
                        <label for="">Описание</label>
                        <textarea name="product_description" class="form-control" rows="3"><?=$this->products["description"]?></textarea>
                        
                        
                        
                        <div class="form-group">
                            <label for="">Превью</label>
                            <div><img id="out_product_p_img" src="<?=strlen($this->products["p_img"]) > 0 ? MAIN_PREFIX."/upload/{$this->products["p_img"]}" : ""?>" width="100px;"/></div>
                            <input type="file" class="form-control" name="product_p_img" onchange="showImgFromInput(event)">
                            
                        </div>
                        <div class="form-group">
                            <label for="">Детальная картинка</label>
                            <div><img id="out_product_d_img" src="<?=strlen($this->products["d_img"]) > 0 ? MAIN_PREFIX."/upload/{$this->products["d_img"]}" : ""?>" width="100px;"/></div>
                            <input type="file" class="form-control" name="product_d_img" onchange="showImgFromInput(event)">
                        </div>
                        <div class="form-group">
                            <label for="">Дополнительные картинки</label>
                        <?
                            $imgs = json_decode($this->products["imgs"]);
                            $str_img = "";
                            $i = 0;
                        ?>
                        <?if (is_array($imgs) && count($imgs) > 0):?>
                                <?foreach ($imgs as $img):?> 
                                    <?$str_img .= $img.",";?>
                            <div>
                                <img id="out_<?=$i = $i + 1;?>" src="<?=MAIN_PREFIX."/upload/{$img}"?>" width="100px;"/>
                                <input type="hidden" value="<?=$img?>" name="src_out_<?=$i?>"/>
                                <input type="button" value="Удалить" name="out_<?=$i?>"/>
                                
                            </div>

                                <?endforeach;?>
                            <input type="hidden" value="<?=$str_img?>" name="old_src"/>
                                <script >$('input[type="button"]').on("click", function (event) {
                                    var image = document.getElementById(event.target.name);
                                    var old_src = image.src.split("/");
                                    old_src = [old_src[old_src.length - 2], old_src[old_src.length - 1]].join("/");
                                    image.src = "";
                                    document.getElementsByName(event.target.name)[0].style.display = "none";
                                    var elem = document.getElementsByName("old_src")[0];//.value.replace(old_src.toString(), "");
                                    if (elem.value.includes(old_src)) {
                                        elem.value = elem.value.replace(old_src + ",", "");
                                    }
                                    
                                });</script>
                            <?endif;?>
                        </div>
                        <div class="form-group">
                            <label for="">Дополнительные изображения</label>
                            <input type="file" class="form-control" name="product_imgs[]" multiple >
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="productEdit()">Изменить </button>
            </div>
            

        </div>
    </div>
</div>

