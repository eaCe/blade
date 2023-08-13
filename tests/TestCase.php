<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use RyanChandler\Blade\Blade;

use function dirname;

abstract class TestCase extends BaseTestCase
{
    public static $blade;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        if (self::$blade) {
            return;
        }

        $blade = new Blade('./views', './cache');
        $this->addDirectives($blade);

        self::$blade = $blade;
    }

    /**
     * Add the Blade directives.
     *
     * @return void
     */
    protected function addDirectives($blade)
    {
        $directives = [
            '/lib/directives/article.php',
            '/lib/directives/category.php',
            '/lib/directives/media.php',
            '/lib/directives/translate.php',
            '/lib/directives/request.php',
            '/lib/directives/helpers.php',
        ];

        $directives = collect($directives)
            ->flatMap(static function ($directive) {
                if (file_exists(dirname(__DIR__, 1) . $directive)) {
                    return include dirname(__DIR__, 1) . $directive;
                }
            });

        collect($directives)
            ->each(static function ($directive, $function) use ($blade) {
                $blade->directive($function, $directive);
            });
    }

    /**
     * Compile the Blade directive.
     *
     * @param  string  $directive
     * @return string
     */
    public function compile($directive)
    {
        $compiled = self::$blade->compileString($directive);

        return str_replace(["\n", '  '], '', $compiled);
    }
}
