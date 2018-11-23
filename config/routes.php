<?php

return [
    'update/([0-9]+)' => 'comment/update/$1',
    'delete/([0-9]+)' => 'comment/delete/$1',
    'index' => 'comment/index',
    'login' => 'site/login',
    'signup' => 'site/signup',
    'logout' => 'site/logout',
];