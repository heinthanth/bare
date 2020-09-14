<?php

namespace heinthanth\bare\Foundation;

class BareCLI
{
    public static function makeController(string $name)
    {
        $string = "<?php\n\nnamespace App\Controller;\n\nclass $name\n{\n}\n";

        $file = fopen(__DIR__ . "/../../app/controller/$name.php", "w");
        fwrite($file, $string);
        fclose($file);
    }
}
