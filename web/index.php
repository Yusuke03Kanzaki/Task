<?php

require '../bootstrap.php';
require '../MiniBlogApplication.php';

// echo  111;
$app = new MiniBlogApplication(true);  //trueがデバックモード
// echo 111;
$app->run();
