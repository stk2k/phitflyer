<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

spl_autoload_register(function($class) {
    if (strpos($class, 'EventStream\\') === 0) {
        $dir = strcasecmp(substr($class, -4), 'Test') ? 'src/' : 'tests/';
        $name = substr($class, strlen('EventStream'));
        require __DIR__ . '/../' . $dir . strtr($name, '\\', DIRECTORY_SEPARATOR) . '.php';
    }
});
