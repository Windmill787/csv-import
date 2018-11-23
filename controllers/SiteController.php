<?php

namespace controllers;

/**
 * Class SiteController
 */
class SiteController extends BaseController
{
    public function actionLogin()
    {
        $alert = '';
        $title = 'Login';

        $this->render('login');
    }

    public function actionSignup()
    {

    }
}