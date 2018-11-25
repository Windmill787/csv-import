<h1><?= $this->header ?>
    <?= $this->clear ? '<a href="/result"><i class="fas fa-filter" title="Очистить фильтр"></i></a>' : '' ?>

    <span class="pull-right"><a href="/import">Import data</a></span>
</h1>


<?php if($this->data) { ?>
<form class="form-horizontal" action="export" method="post" name="export" enctype="multipart/form-data">
    <fieldset>

        <!-- Clear all records button -->
        <div class="form-group">
            <label class="col-md-5 control-label" for="singlebutton"></label>
            <div class="col-md-5">
                <button type="submit" id="submit" name="export" class="btn btn-primary button-export" data-loading-text="Loading...">Export</button>
            </div>
        </div>

    </fieldset>
</form>

<?php } ?>

    <table class="table table-bordered">

<?php

/**
 * @var $import \test\models\Import
 */

// uid, name, age, email, phone, gender
foreach ($this->data as $key => $import) {
    if ($key == 0) { ?>

        <thead>
        <tr>
            <?php foreach ($import->getAttributeLabels() as $label) { ?>

                <th scope="col">
                    <a href="/result?<?= $label ?>=<?= $this->sortParam == $label ? $this->sort : $this->sortOther ?>">
                        <?= $label ?>
                        <?= $this->sortParam == $label ? "<i class=\"fas fa-arrow-$this->arrow\"></i>" : '' ?>
                    </a>
                </th>
            <?php } ?>
        </tr>
        </thead>
    <?php } ?>

        <tbody>
        <tr>
            <th scope="row"><?= $import->uid ?></th>
            <td><?= $import->name ?></td>
            <td><?= $import->age ?></td>
            <td><?= $import->email ?></td>
            <td><?= $import->phone ?></td>
            <td><?= $import->gender ?></td>
        </tr>
        </tbody>

<?php } ?>

    </table>

<?php ?>