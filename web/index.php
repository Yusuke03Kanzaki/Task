<?php

require '../bootstrap.php';
require '../MiniBlogApplication.php';

$app = new MiniBlogApplication(false);  //trueがデバックモード
$app->run();
