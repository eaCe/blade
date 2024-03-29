<?php

include_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Str;

class Blade
{
    /**
     * The Blade compiler instance.
     */
    private BladeCompiler $blade;

    /**
     * The addon instance.
     */
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
     * Return a view with the given data.
     *
     * @throws rex_exception
     */
    public static function make(string $view, array $data = []): string
    {
        $instance = rex::getProperty('bladeInstance');

        /**
         * check if view exists.
         * use dump() to show error message for admins.
         */
        if (!$instance->blade->exists($view)) {
            dump('View not found: ' . $view);
            return '';
        }

        if (isset($data['content']) && $data['content'] instanceof rex_article_content) {
            self::shareValues($instance, $data['content']);
        }

        return $instance->blade->make($view, $data)->render();
    }

    /**
     * Share values from article slice.
     *
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

    /**
     * Set directives for the Blade compiler.
     */
    private function setDirectives(BladeCompiler $blade): void
    {
        $directives = rex_extension::registerPoint(new rex_extension_point('BLADE_DIRECTIVES', [
            include 'directives/article.php',
            include 'directives/category.php',
            include 'directives/media.php',
            include 'directives/translate.php',
            include 'directives/request.php',
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

    /**
     * Get parsed arguments from a string.
     */
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

    /**
     * Parse an expression into an array.
     *
     * @param int $limit
     * @return mixed
     */
    public static function parseExpression($expression, $limit = PHP_INT_MAX)
    {
        return collect(explode(',', $expression, $limit))
            ->map(static function ($item) {
                return trim($item);
            });
    }

    /**
     * Strip quotes from a string.
     *
     * @return array|string|string[]
     */
    public static function strip(string $expression)
    {
        return str_replace(["'", '"'], '', $expression);
    }

    /**
     * Remove the leading and trailing delimiter from a string.
     */
    public static function stripDelimiter(string $value, string $delimiter = "'"): string
    {
        if (Str::startsWith($value, $delimiter)) {
            $value = Str::replaceFirst($delimiter, '', $value);
        }

        if (Str::endsWith($value, $delimiter)) {
            $value = Str::replaceLast($delimiter, '', $value);
        }

        return $value;
    }

    /**
     * Adds the default output to newly created module if no output is set.
     *
     * @throws rex_sql_exception
     */
    public static function addModule(array $module): void
    {
        if (isset($module['output']) && '' !== $module['output']) {
            return;
        }

        $moduleName = rex_string::normalize($module['name'], '-');

        if (isset($module['key']) && '' !== $module['key']) {
            $moduleName = $module['key'];
        }

        $output = '<?php echo Blade::make(\'modules.' . $moduleName . '\', [\'content\' => $this]); ?>';

        $sql = rex_sql::factory();
        $sql->setTable(rex::getTable('module'));
        $sql->setWhere(['id' => $module['id']]);
        $sql->setWhere(['name' => $module['name']]);
        $sql->setValue('output', $output);
        $sql->update();

        rex_module_cache::delete($module['id']);
    }
}
