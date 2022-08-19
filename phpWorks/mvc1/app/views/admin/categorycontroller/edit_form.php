<div class="modal fade" id="edit_category_modal" tabindex="-1" role="dialog" aria-labelledby="edit_category_modal_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_category_modal">Редактирование категории</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger error_danger" style="display: none;" role="alert">
                    Произошла ошибка!
                </div>
                <div class="mx-auto">
                    <form id="form_edit_category" method="post" action="<?= ADMIN_PREFIX ?>/category/edit/">
                        <input type="hidden" value="<?=$this->category["id"]?>" name="id"/>
                        <input type="hidden" value="<?=$this->category["depth_level"]?>" name="depth_level"/>
                        <div>
                            Изменяем ID = <span class="edit_id"><?=$this->category["id"]?></span>
                        </div>
                        <div class="form-group">
                            <label for="category_name">Название категории</label>
                            <input type="text" required class="form-control" name="category_name" id="category_name" placeholder="" value="<?=$this->category["name"]?>">
                        </div>
                        <div class="form-group">
                            <label for="category_code">Код категории</label>
                            <input type="text" required class="form-control" name="category_code" id="category_code" placeholder="" value="<?=$this->category["code"]?>">
                        </div>
                        <div class="form-group">
                            <label for="parent_category">Родительская категория</label>
                            <select class="form-control" name="parent_category" id="parent_category">
                                <option value="0" data-depth-level='-1'>.</option>
                                <?foreach ($this->all_category as $category) {
                                    echo '<option value="' . $category["id"] . '" '.($category['id'] == $this->category["parent_id"] ? "selected" : "").' data-depth-level="' . $category["depth_level"] . '">' . $category["name"] . '</option>';
                                }?>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="categoryEdit()">Изменить </button>
            </div>
            

        </div>
    </div>
</div>

