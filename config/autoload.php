<?php
// config/autoload.php

spl_autoload_register(function ($class) {
    $baseDirs = [
        __DIR__ . '/../models/',
        __DIR__ . '/../controllers/',
        __DIR__ . '/../routes/'
    ];
    foreach ($baseDirs as $baseDir) {
        $file = $baseDir . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
