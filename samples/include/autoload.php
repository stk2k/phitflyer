<?php
spl_autoload_register(function($class) {
    if (strpos($class, 'PhitFlyer\\') === 0) {
        $name = substr($class, strlen('PhitFlyer\\'));
        $paths = explode('\\', $name);
        array_unshift($paths,'src');
        $src_root = dirname(dirname(__DIR__));
        $php_source = $src_root . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $paths) . '.php';
        //echo 'php_source:' . $php_source . PHP_EOL;
        require $php_source;
    }
});
