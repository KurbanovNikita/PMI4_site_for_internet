<? require_once DIR_PATH_APP.'/views/admin/header.php'?>
<?if (count($this->arResult["ITEMS"]) > 0):?>


<div id="table_container">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Код</th>
                <th>Уровень</th>
                <th>Кол-во подкатегорий</th>
                <th>Родители</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($this->arResult["ITEMS"] as $category): ?>
                <tr>
                    <td><?= $category["id"] ?></td>
                    <td><?= $category["name"] ?></td>
                    <td><?= $category["code"] ?></td>
                    <td><?= $category["depth_level"] ?></td>
                    <td><?= $category["count_children"] ?></td>
                    <td><?= $category["parent_id"] ?></td>
                    <td>
                        <button onclick="getEditFormByID(<?= $category["id"] ?>)" class="btn btn-info">Изменить</button>
                        &nbsp;
                        <button onclick="categoryDelete(<?= $category["id"] ?>, '<?= $category["name"] ?>')" class="btn btn-danger">Удалить</button>
                    </td>
                </tr>
            <? endforeach; ?>
        </tbody>
        <tfoot></tfoot>
    </table>
<? else: ?>
    <div class="alert alert-danger error_danger" role="alert">
        Нет категорий по вашему выбору!!!
    </div>
<? endif ?>
</div>
<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new_category_modal">
            Добавить категорию
        </button>
    </div>
</div>

<div class="modal fade" id="new_category_modal" tabindex="-1" role="dialog" aria-labelledby="new_category_modal_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new_category_modal">Добавление категории</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_new_category" method="post" action="<?= ADMIN_PREFIX ?>/category/add/">
                <div class="modal-body">
                    <div class="alert alert-danger error_danger" style="display: none;" role="alert">
                        Произошла ошибка!
                    </div>
                    <div class="mx-auto">
                        <input type="hidden" value="0" name="depth_level"/>
                        <div class="form-group">
                            <label for="category_name">Название категории</label>
                            <input type="text" required class="form-control" name="category_name" id="category_name" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="category_code">Код категории</label>
                            <input type="text" required class="form-control" name="category_code" id="category_code" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="parent_category">Родительская категория</label>
                            <select class="form-control" name="parent_category" id="parent_category">
                                <option value="0" data-depth-level='-1'>.</option>
                                <?foreach($this->arResult["ITEMS"] as $category){
                                    echo '<option value="'.$category["id"].'" data-depth-level="'.$category["depth_level"].'">'.$category["name"].'</option>';
                                }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="add_new_category" onclick="add_new_category()">Добавить </button>
                </div>
            </form>

        </div>
    </div>
</div>
<? require_once DIR_PATH_APP.'/views/admin/footer.php'?>
