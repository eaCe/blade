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

    private static function setDirectives($blade): void
    {
        $directives = \rex_extension::registerPoint(new \rex_extension_point('BLADE_DIRECTIVES', [
            include 'directives/article.php',
            include 'directives/helpers.php',
        ]));

        $directives = collect($directives)
            ->flatMap(static function ($directive) {
                return $directive;
            });

        collect($directives)
            ->each(static function ($directive, $function) use ($blade) {
                $blade->directive($function, $directive);
            });
    }

    public static function getParsedArgs(string $arguments = ''): array
    {
        if (!$arguments) {
            return [];
        }

        $arguments = array_map('trim', explode(',', $arguments));
        $argumentsArray = [];
        foreach ($arguments as $argument) {
            $argumentArray = explode('=', $argument);
            $argumentsArray[$argumentArray[0]] = $argumentArray[1];
        }
        return $argumentsArray;
    }
}
