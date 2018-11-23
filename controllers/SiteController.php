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
    public function actionIndex()
    {
        $this->render('index', [
            'content' => 'index',
        ]);
    }

    /**
     *
     */
    public function actionLogin()
    {
        $this->render('index', [
            'content' => 'login',
        ]);
    }
}