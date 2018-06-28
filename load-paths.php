<?php

$rootPath = realpath('.');

$composeSubFolder = function ($path, $folder) {
    return $path . DIRECTORY_SEPARATOR . $folder;
};

$libPath = $composeSubFolder($rootPath, 'lib');
set_include_path(get_include_path() . PATH_SEPARATOR . $libPath);

$srcPath = $composeSubFolder($rootPath, 'src');
set_include_path(get_include_path() . PATH_SEPARATOR . $srcPath);
