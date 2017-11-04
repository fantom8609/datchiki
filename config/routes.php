<?php

return array(
    'cabinet/index.php' => 'cabinet/index',
    'cabinet/login' => 'cabinet/login',
    'delete/([0-9]+)' => 'site/deleteDatchik/$1',
    // Главная страница
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);
