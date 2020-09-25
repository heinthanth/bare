<?php

require_once __DIR__ . "/../config/bootstrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$action = $argv[1];

switch ($action):
    case 'migrate':
        $option = $argv[2] ?? '';

        if ($option === '--fresh') :
            Capsule::schema()->dropAllTables();
            foreach (glob(__DIR__ . "/../database/migrations/create_*_table.php") as $file) :
                include_once $file;
            endforeach;
        else :
            foreach (glob(__DIR__ . "/../database/migrations/create_*_table.php") as $file) :
                $basename = pathinfo($file, PATHINFO_BASENAME);
                if (preg_match('/create_(.*)_table\.php/', $basename, $matched)) :
                    $table = $matched[1];
                    if (!Capsule::schema()->hasTable($table)) :
                        include_once $file;
                    endif;
                endif;
            endforeach;
        endif;

        break;
    case 'drop':
        Capsule::schema()->dropAllTables();
        break;
endswitch;
