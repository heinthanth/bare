<?php

$config = require_once __DIR__ . '/env.php';

// add config to $_ENV
foreach ($config as $k => $v) :
    putenv("$k=$v");
endforeach;
