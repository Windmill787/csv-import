<?php

namespace test\controllers;

/**
 * Class SiteController
 */
class SiteController extends BaseController
{
    /**
     *
     */
    public function actionImport()
    {
        return $this->render('import', [
            'ty' => 'Hello',
        ]);
    }

    /**
     *
     */
    public function actionResult()
    {
        return $this->render('result', [
            'content' => 'Results',
        ]);
    }
}