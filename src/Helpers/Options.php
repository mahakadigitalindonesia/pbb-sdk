<?php


namespace Mdigi\PBB\Helpers;


class Options
{
    const VIEWS_PATH = 'views/vendor/mdigi/pbb';

    public static function isConfigPublished()
    {
        return file_exists(config_path('pbb.php'));
    }

    public static function isViewsPublished()
    {
        return is_dir(resource_path(self::VIEWS_PATH));
    }
}