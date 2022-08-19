
<?if (count($this->arResult["ITEMS"]) > 0):?>
<table class="table table-striped">
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
        <?foreach($this->arResult["ITEMS"] as $section):?>
            <tr>
                <td><?=$section["id"]?></td>
                <td><?=$section["name"]?></td>
                <td><?=$section["code"]?></td>
                <td><?=$section["depth_level"]?></td>
                <td><?=$section["count_children"]?></td>
                <td><?=$section["parent_id"]?></td>
                <td>
                    <button onclick="getEditFormByID(<?=$section["id"]?>)" class="btn btn-info">Изменить</button>
                    &nbsp;
                    <button onclick="sectionDelete(<?=$section["id"]?>, '<?=$section["name"]?>')" class="btn btn-danger">Удалить</button>
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
