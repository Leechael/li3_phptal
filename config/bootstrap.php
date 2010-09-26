<?php

use \lithium\core\Libraries;
use \lithium\net\http\Media;

$prefix = dirname(__DIR__);

Libraries::add('PHPTAL', array(
    'prefix' => 'PHPTAL_',
    'path' => $prefix . '/libraries/PHPTAL',
    'includePath' => $prefix . '/libraries/PHPTAL',
    'bootstrap' => 'PHPTAL.php',
    'loader' => array('PHPTAL', 'autoload'),
));

Media::type('html', null, array('view' => '\li3_phptal\template\View'));
