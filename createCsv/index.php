<?php

$path = __DIR__;
$count = 0;

function get_file_name($dir){
    if(is_dir($dir) && $handle = opendir($dir)){
        $files = array();
        while(($file = readdir($handle)) !== false){
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if ($ext == "jpg") {
                $zero_add = $dir."/".$file;
                rename($zero_add, $dir."/0".$file);
            }
        }
    }
}

$current_dir = scandir($path);
foreach ($current_dir as $value) {
    if (is_dir($value)) {
        if ($value != "." && $value != "..") {
            $dir_path = $path."/".$value;
            get_file_name($dir_path);
        }
    }
}


function getFiles($path, $count) {

    // new line code
    $new_line = "\r\n"; // windows => linux "\n"

    // rename extension
    $target = ".jpg";

    // first
    $result = array();

    // glob array sort
    $files = glob($path."/*", GLOB_NOSORT);
    natsort($files);

    // var_dump($files);
    // print_r($files);

    foreach($files as $file) {

        // print_r($file."\n");

        // stripos() 大文字小文字区別なし / strpos 区別あり
        if(stripos($file, $target) !== false) {

            $befor = str_replace(basename($file), md5(uniqid(rand(),1)).$target, $file);
            // rename($file, $befor);

            print_r($befor."\n");

            print_r(__DIR__."\n");

            $replace_path = substr( str_replace(array(__DIR__, "/ans"), array("", ""), $path), 1);
            $check_str = preg_replace('/[0-9]|[_]/', '', $replace_path);

            if(!empty($check_str)) {
                if(stripos($check_str, "n") !== false) {

                    if(strlen($check_str) === 1) {
                        $quiz = "ランでないのは、どれですか？";
                    } else if($check_str === "ns") {
                        $quiz = "シンビジウムでないのは、どれですか？";
                    } else if($check_str === "np") {
                        $quiz = "パフィオペディラムでないのは、どれですか？";
                    } else if($check_str === "ne") {
                        $quiz = "エビネでないのは、どれですか？";
                    } else if($check_str === "nk") {
                        $quiz = "コチョウランでないのは、どれですか？";
                    } else if($check_str === "nc") {
                        $quiz = "カランセでないのは、どれですか？";
                    } else if($check_str === "nj") {
                        $quiz = "日本の野生蘭でないのは、どれですか？";
                    }

                } else if($check_str === "p") {
                    $quiz = "パフィオペディラムは、どれですか？";
                } else if($check_str === "s") {
                    $quiz = "シンビジウムは、どれですか？";
                } else if($check_str === "e") {
                    $quiz = "エビネは、どれですか？";
                } else if($check_str === "k") {
                    $quiz = "コチョウランは、どれですか？";
                } else if($check_str === "c") {
                    $quiz = "カランセは、どれですか？";
                } else if($check_str === "j") {
                    $quiz = "日本の野生蘭は、どれですか？";
                }

            } else {
                $quiz = "ランは、どれですか？";
            }

            $file = $befor;

            // print_r($file."\n");

            // create CSV file "ans" 3
            $csv = fopen("test.csv", "a");

            if($count%3 == 0) {
                @fwrite($csv, $new_line);
                @fwrite($csv, $quiz.",");
            } else {
                @fwrite($csv, ",");
            }


            $str = str_replace($target, '', basename($befor));
            @fwrite($csv, $str);

            $count++;

            fclose($csv);

        }

        if(is_dir($file)) {
            $result = array_merge($result, getFiles($file, $count));
        }

        $result[] = basename($file);
    }

    return $result;
}

getFiles($path, $count);
