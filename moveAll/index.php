<?php

function getFiles($path) {

    // rename extension
    $target = ".jpg";

    // move foldor
    $export = "../hoge/";

    // first
    $result = array();

    // glob array sort
    $files = glob($path."/*", GLOB_NOSORT);
    natsort($files);

    foreach($files as $file) {

        // stripos() 大文字小文字区別なし / strpos 区別あり
        if(stripos($file, $target) !== false) {
            $tmp = explode("/", $file);
            $replace = end($tmp);
            rename($file, $export.$replace);
        }

        if(is_dir($file)) {
            $result = array_merge($result, getFiles($file));
        }

        $result[] = basename($file);
    }

    return $result;
}

$path = __DIR__;

getFiles($path);
