<?php

return array(
    'cabinet/ustanovka/([0-9]+)' => 'cabinet/ustanovka/$1',
	'cabinet/trig/([0-9]+)' => 'cabinet/trig/$1',
    'cabinet/index.php' => 'cabinet/index',
    'cabinet/login' => 'cabinet/login',
    'delete_ustr/([0-9]+)' => 'site/deleteUstroistvo/$1',
    'delete/([0-9]+)' => 'site/deleteDatchik/$1',
    // Главная страница
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);
