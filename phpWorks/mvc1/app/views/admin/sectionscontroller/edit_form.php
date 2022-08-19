<div class="modal fade" id="edit_section_modal" tabindex="-1" role="dialog" aria-labelledby="edit_section_modal_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_section_modal">Редактирование категории</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger error_danger" style="display: none;" role="alert">
                    Произошла ошибка!
                </div>
                <div class="mx-auto">
                    <form id="form_edit_section" method="post" action="<?= ADMIN_PREFIX ?>/sections/edit/">
                        <input type="hidden" value="<?=$this->section["id"]?>" name="id"/>
                        <input type="hidden" value="<?=$this->section["depth_level"]?>" name="depth_level"/>
                        <div>
                            Изменяем ID = <span class="edit_id"><?=$this->section["id"]?></span>
                        </div>
                        <div class="form-group">
                            <label for="section_name">Название категории</label>
                            <input type="text" required class="form-control" name="section_name" id="section_name" placeholder="" value="<?=$this->section["name"]?>">
                        </div>
                        <div class="form-group">
                            <label for="section_code">Код категории</label>
                            <input type="text" required class="form-control" name="section_code" id="section_code" placeholder="" value="<?=$this->section["code"]?>">
                        </div>
                        <div class="form-group">
                            <label for="parent_section">Родительская категория</label>
                            <select class="form-control" name="parent_section" id="parent_section">
                                <option value="0" data-depth-level='-1'>.</option>
                                <?foreach ($this->all_sections as $section) {
                                    echo '<option value="' . $section["id"] . '" '.($section['id'] == $this->section["parent_id"] ? "selected" : "").' data-depth-level="' . $section["depth_level"] . '">' . $section["name"] . '</option>';
                                }?>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="sectionEdit()">Изменить </button>
            </div>
            

        </div>
    </div>
</div>

