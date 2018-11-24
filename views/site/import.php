<?php
echo '<h1>'.$this->header.'</h1>';
?>


<div class="container">
    <div class="row">

        <form class="form-horizontal" action="import" method="post" name="upload" enctype="multipart/form-data">
            <fieldset>

                <!-- File Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="filebutton">Выберите файл</label>
                    <div class="col-md-4">
                        <input type="file" name="file" id="file" class="input-large">
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton">Импортировать</label>
                    <div class="col-md-4">
                        <button type="submit" id="submit" name="import" class="btn btn-primary button-loading" data-loading-text="Loading...">Импортировать</button>
                    </div>
                </div>

            </fieldset>
        </form>

    </div>