<script
    type="text/javascript"
    src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js'
    referrerpolicy="origin">
</script>
<script type="text/javascript">

</script>

<div class="modal fade" id="edit_news_modal" tabindex="-1" role="dialog" aria-labelledby="edit_news_modal_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_news_modal">Редактирование категории</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger error_danger" style="display: none;" role="alert">
                    Произошла ошибка!
                </div>
                <div class="mx-auto">
                    <form id="form_edit_news" name="form_edit_news" method="post" action="<?= ADMIN_PREFIX ?>/news/edit/">
                        <input type="hidden" value="<?=$this->news["id"]?>" name="id"/>
                        <div>
                            Изменяем ID = <span class="edit_id"><?=$this->news["id"]?></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="news_title">Заголовок</label>
                            <input type="text" required class="form-control" name="news_title" id="news_title" placeholder="" value="<?=$this->news["title"]?>">
                        </div>
                        <div class="form-group">
                            <label for="news_code">Код новости</label>
                            <input type="text" required class="form-control" name="news_code" id="news_code" placeholder="" value="<?=$this->news["code"]?>">
                        </div>
                        <div class="form-group">
                            <label for="parent_category">Категория</label>
                            <select class="form-control" name="parent_category" id="parent_category">
                                <option value="0" data-depth-level='-1'>.</option>
                                <?foreach($this->all_categories as $category){
                                    echo '<option value="' . $category["id"] . '" '.($category['id'] == $this->news["category_id"] ? "selected" : "").' data-depth-level="' . $category["depth_level"] . '">' . $category["name"] . '</option>';
                                }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="news_description">Краткое описание</label>
                            <input type="text" required class="form-control" name="news_description" id="news_description" placeholder="" value="<?=$this->news["description"]?>">
                        </div>
                        <div class="form-group">
                            <label for="">Изображение предпоказа</label>
                            <div><img id="out_news_p_img" src="<?=strlen($this->news["p_img"]) > 0 ? MAIN_PREFIX."/upload/{$this->news["p_img"]}" : ""?>" width="100px;"/></div>
                            <input type="file" class="form-control" name="news_p_img">
                        </div>
                        <div class="form-group">
                            <label for="">Основная картинка</label>
                            <div><img id="out_news_p_img" src="<?=strlen($this->news["d_img"]) > 0 ? MAIN_PREFIX."/upload/{$this->news["d_img"]}" : ""?>" width="100px;"/></div>
                            <input type="file" class="form-control" name="news_d_img">
                        </div>
                        <div class="form-group">
                            <label for="">Содержание</label>
                            <textarea name="news_text_2" class="form-control" id="news_text_2"><? echo htmlspecialchars_decode($this->news["text"])?></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="newsEdit()">Изменить </button>
            </div>
            

        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    tinymce.init({
        selector: '#news_text_2',
        plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'table emoticons template paste help'
        ],
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                'forecolor backcolor emoticons | help | tablecellvalign',

        menubar: 'favs file edit view insert format tools table help',

    });
    
    //tinymce.get("news_text_2").setContent();
});
</script>