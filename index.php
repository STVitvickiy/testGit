<?php

require_once "vendor/autoload.php";


$class = new \Uploader\uploaderClass();
$class->setModeSave(false);
//print_r($class->upload("http://33.media.tumblr.com/e853f5cb103e6290a4342442be239b68/tumblr_mmocik4ZSB1qk2fijo1_400.gif"));
$test = new \Uploader\Test\ExampleTest();
$test->testUploaderFalse();