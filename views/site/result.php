<h1><?= $this->header ?></h1>

    <table class="table">

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
            <td>@<?= $import->email ?></td>
            <td>@<?= $import->phone ?></td>
            <td>@<?= $import->gender ?></td>
        </tr>
        </tbody>

<?php } ?>

    </table>
<?php ?>
