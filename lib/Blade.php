<?php

include_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;

class Blade
{
    private BladeCompiler $blade;
    private rex_addon_interface $addon;

    public function __construct()
    {
        $this->addon = rex_addon::get('blade');
        $viewPaths = [$this->addon->getDataPath('views')];

        if (rex_addon::exists('theme') && rex_addon::get('theme')->isAvailable()) {
            $viewPaths[] = theme_path::views();
        }

        $this->blade = new BladeCompiler($viewPaths, $this->addon->getCachePath('views'));
        $this->setDirectives($this->blade);
    }

    /**
     * @throws rex_exception
     */
    public static function make(string $view, array $data = []): string
    {
        $instance = rex::getProperty('bladeInstance');

        if (isset($data['content']) && $data['content'] instanceof rex_article_content) {
            self::shareValues($instance, $data['content']);
        }

        return $instance->blade->make($view, $data)->render();
    }

    /**
     * share values from article slice.
     * @throws rex_exception
     */
    private static function shareValues(self $instance, rex_article_content $content): void
    {
        /** @var rex_article_slice $slice */
        $slice = $content->getCurrentSlice();
        $instance->blade->container->singleton('app', Container::class);
        Facade::setFacadeApplication($instance->blade->container);

        $sql = rex_sql::factory();
        $sql->setQuery('SELECT * FROM ' . rex::getTable('article_slice') . ' WHERE id = ?', [$slice->getId()]);
        $sliceData = $sql->getArray()[0];

        foreach ($sliceData as $key => $value) {
            if (!str_starts_with($key, 'value')
                && !str_starts_with($key, 'media')
                && !str_starts_with($key, 'link')) {
                continue;
            }
            $instance->blade->share($key, $value);
        }
    }

    private function setDirectives(BladeCompiler $blade): void
    {
        $directives = \rex_extension::registerPoint(new \rex_extension_point('BLADE_DIRECTIVES', [
            include 'directives/article.php',
            include 'directives/category.php',
            include 'directives/translate.php',
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
