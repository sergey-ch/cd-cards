<?php
    $fields = \App\models\Cd::getFormFields();
?>

<form action="/" method="get" id="filter-form">
    <div class="form-group">
        <label for="filter_field">Фильтр по полю</label>
        <select id="filter_field" class="form-control" name="filter_field">
            <?php foreach ($fields as $fieldValue => $fieldName) : ?>
                <option value="<?= $fieldValue ?>" <?= $_REQUEST['filter_field'] == $fieldValue ? 'selected' : '' ?>>
                    <?= $fieldValue ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <br>
        
        <input type="text" id="filter_value" class="form-control" name="filter_value" 
               value="<?= $_REQUEST['filter_value'] ?? '' ?>" placeholder="Значение фильтра">
    </div>
    
    <div class="form-group">
        <label for="sort">Сортировка по полю</label>
        <select id="sort" class="form-control" name="sort">
            <?php foreach ($fields as $fieldValue => $fieldName) : ?>
            <option value="<?= $fieldValue ?>" <?= $_REQUEST['sort'] == $fieldValue ? 'selected' : '' ?>>
                <?= $fieldValue ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="direction">Направление сортировки</label>
        <select id="direction" class="form-control" name="direction">
            <option value="ASC" <?= $_REQUEST['direction'] == 'ASC' ? 'selected' : '' ?>>ASC</option>
            <option value="DESC" <?= $_REQUEST['direction'] == 'DESC' ? 'selected' : '' ?>>DESC</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>