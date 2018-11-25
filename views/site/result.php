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
            <form class="form-horizontal filter-form" action="result" method="post" name="result" enctype="multipart/form-data">
            <?php foreach ($import->getAttributeLabels() as $index => $label) { ?>

                <th scope="col">

                    <?php if ($index != 5) { ?>
                        <input type="text" name="<?= $label ?>" class="form-control filter <?= $label ?>" placeholder="Filter by <?= $label ?>" value="<?= isset($this->filterParams[$label]) ? $this->filterParams[$label] : '' ?>">
                    <?php } else { ?>
                        <select class="form-control">
                            <option></option>
                            <option>male</option>
                            <option>female</option>
                        </select>
                    <?php } ?>

                    <a href="#" class="sort" data-sort="<?= $this->sortParam == $label ? $this->sort : $this->sortOther ?>" data-attribute="<?= $label ?>">
                        <?= $label ?>
                        <?= $this->sortParam == $label ? "<i class=\"fas fa-arrow-$this->arrow\"></i>" : '' ?>
                    </a>
                </th>
            <?php } ?>
            </form>
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
<script>
    var getParams = ['uid', 'name', 'age', 'email', 'phone', 'gender'];
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    var redirect = '/result';
    var sortDesc = getUrlParameter('sortDESC');
    var sortAsc = getUrlParameter('sortASC');

    function setRedirect() {
        $.each(getParams, function(index, value) {
            if (getUrlParameter(value)) {

                if (redirect !== '/result') {
                    redirect += '&';
                } else {
                    redirect += '?';
                }
                redirect += value + "=" + $('.'+value).val();
            }
        });
    }

    $('.sort').on('click', function () {

        setRedirect();
            if (redirect !== '/result') {
                redirect += '&';
            } else {
                redirect += '?';
            }
            redirect += 'sort' + $(this).data('sort') + "=" + $(this).data('attribute');
        window.location.replace(redirect);
    });

    $('.filter').keypress(function (e) {
        if (e.which == 13 && $(this).val() !== '') {


            if (getUrlParameter($(this).attr('name')) == undefined) {
                if (redirect !== '/result') {
                    redirect += '&';
                } else {
                    redirect += '?';
                }
                redirect += $(this).attr('name') + "=" + $(this).val();
            }

            setRedirect();

            if (sortDesc || sortAsc) {
                if (redirect !== '/result') {
                    redirect += '&';
                } else {
                    redirect += '?';
                }

                var sort;
                var attribute;
                if (sortDesc == undefined) {
                    sort = 'sortAsc';
                    attribute = sortAsc;
                } else {
                    sort = 'sortDesc';
                    attribute = sortDesc;
                }

                redirect += 'sort' + sort + "=" + attribute;
            }
            window.location.replace(redirect);
        }
    });
</script>
