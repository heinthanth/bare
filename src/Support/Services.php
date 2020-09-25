<?php

namespace heinthanth\bare\Support;

class Services
{
    private static function loads()
    {
        $services = (require_once BARE_PROJECT_ROOT . "/config/app.php");
        return (is_array($services)) ? $services : [];
    }

    public static function get(string $needle)
    {
        $services = static::loads();
        return arr_get($needle, $services);
    }
}
