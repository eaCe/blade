<?php

include_once __DIR__ . '/vendor/autoload.php';

use RyanChandler\Blade\Blade as RBlade;

class Blade
{
    public static function make(string $view, array $data = [])
    {
        $addon = rex_addon::get('blade');
        $blade = new RBlade($addon->getDataPath('views'), $addon->getCachePath('views'));

        self::setDirectives($blade);

        return $blade->make($view, $data)->render();
    }

    private static function setDirectives($blade)
    {
        $directives = \rex_extension::registerPoint(new \rex_extension_point('BLADE_DIRECTIVES', [
            include 'directives/Article.php',
            include 'directives/Helpers.php',
        ]));

        $directives = collect($directives)
            ->flatMap(function ($directive)
            {
                return $directive;
            });

        collect($directives)
            ->each(function ($directive, $function) use ($blade)
            {
                $blade->directive($function, $directive);
            });
    }
}