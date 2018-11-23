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
    public function actionLogin()
    {
        $this->render('login', [
            'content' => 'Hello world',
        ]);
    }

    /**
     *
     */
    public function actionSignup()
    {

    }
}