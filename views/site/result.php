<h1><?= $this->header ?>
    <?= $this->clear ? '<a href="/result"><i class="fas fa-filter" title="Очистить фильтр"></i></a>' : '' ?>

    <span class="pull-right"><a href="/import">Import data</a></span>
</h1>

<?php if ($this->data) { ?>

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

<?php } else { ?>

    <div class="alert alert-info">There are no records</div>

<?php } ?>