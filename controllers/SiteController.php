<?php

namespace test\controllers;

use test\components\Controller;
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
        $data = Import::findAll();

        return $this->render('result', [
            'title' => 'Результаты',
            'header' => 'Результаты',
            'data' => $data,
        ]);
    }
}