<?php

namespace heinthanth\bare\Support;

class Services
{
    public static function loads()
    {
        $services = (require_once BARE_PROJECT_ROOT . "/config/services.php");
        return (is_array($services)) ? $services : [];
    }

    public static function get(string $needle)
    {
        $services = static::loads();
        return arr_get($needle, $services);
    }
}
