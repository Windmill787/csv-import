<h1><?= $this->header ?>
    <span class="pull-right"><a href="/result">View results</a></span>
</h1>

<div class="container">
    <div class="row">

        <form class="form-horizontal import-form" action="import" method="post" name="upload" enctype="multipart/form-data">
            <fieldset>

                <!-- File Button -->
                <div class="form-group">
                    <label class="col-md-5 control-label" for="filebutton"></label>
                    <div class="col-md-5">
                        <input type="file" name="file" id="file" class="input-large" data-max-size="1000000">
                    </div>
                </div>

                <!-- Import button -->
                <div class="form-group">
                    <label class="col-md-5 control-label" for="singlebutton"></label>
                    <div class="col-md-5">
                        <button type="submit" id="submit" name="import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                    </div>
                </div>

            </fieldset>
        </form>

        <form class="form-horizontal" action="clear" method="post" name="clear" enctype="multipart/form-data">
            <fieldset>

                <!-- Clear all records button -->
                <div class="form-group">
                    <label class="col-md-5 control-label" for="singlebutton"></label>
                    <div class="col-md-5">
                        <button type="submit" id="submit" name="import" class="btn btn-primary button-clearing" data-loading-text="Loading...">Clear all records</button>
                    </div>
                </div>

            </fieldset>
        </form>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('.button-clearing').click(function() {
            if (confirm('Are you sure you want to clear all records?')) {
                return true;
            } else {
                return false;
            }
        });
    });

    $(function() {
        var fileInput = $('#file');
        var maxSize = fileInput.data('max-size');
        $('.import-form').submit(function(e) {
            if (fileInput.get(0).files.length) {
                var fileSize = fileInput.get(0).files[0].size;
                if (fileSize > maxSize) {
                    alert('File size is more then 1 megabyte');
                    return false;
                }
                var fileExtension = ['csv'];
                if ($.inArray(fileInput.val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    alert("Only CSV format is allowed");
                    return false;
                }
            } else {
                alert('Choose file, please');
                return false;
            }
        });
    });
</script>