<? require_once DIR_PATH_APP.'/views/admin/header.php'?>

<?if (count($this->arResult["ITEMS"]) > 0):?>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Заголовок</th>
            <th>Превью</th>
            <th>Главная</th>
            <th>Описание</th>
            <th>Код</th>
            <th>Категория</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?foreach($this->arResult["ITEMS"] as $news):?>
            <tr>
                <td><?=$news["id"]?></td>
                <td><?=$news["title"]?></td>
                <td><?=strlen($news["p_img"]) > 0 ? "<img src='".MAIN_PREFIX."/upload/{$news["p_img"]}' width='100px'/>": ""?></td>
                <td><?=strlen($news["d_img"]) > 0 ? "<img src='".MAIN_PREFIX."/upload/{$news["d_img"]}' width='100px'/>": ""?></td>
                <td><?=$news["description"]?></td>
                <td><?=$news["code"]?></td>
                <td><?=$news["category_id"]?></td>
                <td>
                    
                    <button onclick="getEditFormByID(<?=$news["id"]?>)" class="btn btn-info">Изменить</button>
                    &nbsp;
                    <button onclick="newsDelete(<?=$news["id"]?>, '<?=$news["title"]?>')" class="btn btn-danger">Удалить</button>
                    
                </td>
            </tr>
        <?endforeach;?>
    </tbody>
    <tfoot></tfoot>
</table>
<?else:?>
    <div class="alert alert-danger error_danger" role="alert">
        Нет новостей по вашему запросу!!!
    </div>
<?endif?>

<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new_news_modal">
            Добавить новость
        </button>
    </div>
</div>

<div class="modal fade" id="new_news_modal" tabindex="-1" role="dialog" aria-labelledby="new_news_modal_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new_news_modal">Новая новость</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_new_news" name="form_new_news" method="post" action="<?= ADMIN_PREFIX ?>/news/add/">
                <div class="modal-body">
                    <div class="alert alert-danger error_danger" style="display: none;" role="alert">
                        Произошла ошибка!
                    </div>
                    <div class="mx-auto">
                        
                        <div class="form-group">
                            <label for="news_title">Заголовок</label>
                            <input type="text" required class="form-control" name="news_title" id="news_title" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="news_code">Код новости</label>
                            <input type="text" required class="form-control" name="news_code" id="news_code" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="parent_category">Категория</label>
                            <select class="form-control" name="parent_category" id="parent_category">
                                <option value="0" data-depth-level='-1'>.</option>
                                <?foreach($this->categories as $category){
                                    echo '<option value="'.$category["id"].'">'.$category["name"].'</option>';
                                }?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="news_description">Краткое описание</label>
                            <input type="text" required class="form-control" name="news_description" id="news_description" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Изображение предпоказа</label>
                            <input type="file" class="form-control" name="news_p_img">
                        </div>
                        <div class="form-group">
                            <label for="">Основная картинка</label>
                            <input type="file" class="form-control" name="news_d_img">
                        </div>
                        <div class="form-group">
                            <label for="">Содержание</label>
                            <textarea name="news_text" class="form-control" id="news_text"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="add_new_section">Добавить </button>
                </div>
            </form>

        </div>
    </div>
</div>
<? require_once DIR_PATH_APP.'/views/admin/footer.php'?>

