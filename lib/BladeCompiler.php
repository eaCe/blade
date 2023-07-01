<?php

use Illuminate\Config\Repository;
use Illuminate\Contracts\Container\Container as ContainerContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\View\Compilers\BladeCompiler as Compiler;
use Illuminate\View\ViewServiceProvider;
use RyanChandler\Blade\Container;

/**
 * @mixin \Illuminate\Contracts\View\Factory
 * @mixin \Illuminate\View\Compilers\BladeCompiler
 */
class BladeCompiler
{
    protected Factory $factory;

    protected Compiler $compiler;

    final public function __construct(
        protected string|array $viewPaths,
        protected string $cachePath,
        public bool $cache = false,
        public ?ContainerContract $container = null,
    ) {
        $this->viewPaths = Arr::wrap($viewPaths);

        $this->init();
    }

    /**
     * terminate the container.
     */
    public function teardown(): void
    {
        $this->container->terminate();
    }

    protected function init(): void
    {
        $this->cache = \rex_extension::registerPoint(new \rex_extension_point('BLADE_CACHE', $this->cache));
        $this->container ??= new Container();
        $this->container->singleton('files', static fn () => new Filesystem());
        $this->container->singleton('events', static fn () => new Dispatcher());
        $this->container->singleton('config', fn () => new Repository([
            'view.paths' => $this->viewPaths,
            'view.compiled' => $this->cachePath,
            'view.cache' => $this->cache,
        ]));

        (new ViewServiceProvider($this->container))->register();

        $this->factory = $this->container->get('view');
        $this->compiler = $this->container->get('blade.compiler');
    }

    public function __call(string $name, array $arguments): mixed
    {
        if (method_exists($this->compiler, $name)) {
            return $this->compiler->{$name}(...$arguments);
        }

        return $this->factory->{$name}(...$arguments);
    }

    public static function new(string $viewPath, string $cachePath, ContainerContract $container = null)
    {
        return new static($viewPath, $cachePath, $container);
    }
}
