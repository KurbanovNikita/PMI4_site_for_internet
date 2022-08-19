
<?if (count($this->arResult["ITEMS"]) > 0):?>
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
        <?foreach($this->arResult["ITEMS"] as $category):?>
            <tr>
                <td><?=$category["id"]?></td>
                <td><?=$category["name"]?></td>
                <td><?=$category["code"]?></td>
                <td><?=$category["depth_level"]?></td>
                <td><?=$category["count_children"]?></td>
                <td><?=$category["parent_id"]?></td>
                <td>
                    <button onclick="getEditFormByID(<?=$category["id"]?>)" class="btn btn-info">Изменить</button>
                    &nbsp;
                    <button onclick="categoryDelete(<?=$category["id"]?>, '<?=$category["name"]?>')" class="btn btn-danger">Удалить</button>
                </td>
            </tr>
        <?endforeach;?>
    </tbody>
    <tfoot></tfoot>
</table>
<?else:?>
    <div class="alert alert-danger error_danger" role="alert">
        Нет категорий по вашему выбору!!!
    </div>
<?endif?>
