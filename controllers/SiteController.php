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
            $import->importCsv($_FILES);

            header('Location: /import');
        }

        return $this->render('import', [
            'title' => 'Импорт',
            'header' => 'Импорт',
        ]);
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
            'title' => 'Результаты',
            'header' => 'Результаты',
            'data' => $data,
            'sort' => $sortParam == Model::SORT_DESC ? Model::SORT_ASC : Model::SORT_DESC,
            'sortOther' => Model::SORT_DESC,
            'sortParam' => key(array_reverse($getParams)),
        ]);
    }
}