<?php

namespace test\controllers;

use test\components\Controller;
use test\components\Model;
use test\components\Router;
use test\models\Import;

/**
 * Class SiteController
 */
class SiteController extends Controller
{
    /**
     *
     */
    public function actionImport()
    {
        if ($_POST) {

            $import = new Import();
            if ($import->importCsv($_FILES)) {

                return $this->render('import', [
                    'title' => 'Import',
                    'header' => 'Import',
                    'success' => 'File successfully imported',
                ]);
            } else {

                return $this->render('import', [
                    'title' => 'Import',
                    'header' => 'Import',
                    'error' => 'Wrong file format',
                ]);
            }
        }

        return $this->render('import', [
            'title' => 'Import',
            'header' => 'Import',
        ]);
    }

    public function actionExport()
    {
        if ($_POST) {

            Import::exportCsv();
        }
    }

    /**
     *
     */
    public function actionResult()
    {
        $getParams = Router::getGetParams();

        $data = Import::findAll($getParams);

        $sortParam = end($getParams);

        return $this->render('result', [
            'title' => 'Results',
            'header' => 'Results',
            'error' => !$data ? 'There are no records' : null,
            'data' => $data,
            'sort' => $sortParam == Model::SORT_DESC ? Model::SORT_ASC : Model::SORT_DESC,
            'sortOther' => Model::SORT_DESC,
            'sortParam' => key(array_reverse($getParams)),
            'arrow' => $sortParam == Model::SORT_DESC ? 'down' : 'up',
            'clear' => $getParams ? true : false,
        ]);
    }

    /**
     *
     */
    public function actionClear()
    {
        if ($_POST) {

            Import::deleteAll();

            return $this->render('import', [
                'title' => 'Import',
                'header' => 'Import',
                'success' => 'All records were successfully removed',
            ]);
        }

        return $this->render('import', [
            'title' => 'Import',
            'header' => 'Import',
        ]);
    }
}