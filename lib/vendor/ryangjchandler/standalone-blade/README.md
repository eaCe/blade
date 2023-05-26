# Use Laravel's Blade templating engine outside of Laravel.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ryangjchandler/standalone-blade.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/standalone-blade)
[![Tests](https://github.com/ryangjchandler/standalone-blade/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/ryangjchandler/standalone-blade/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ryangjchandler/standalone-blade.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/standalone-blade)

This package provides a standalone version of Laravel's Blade templating engine for use outside of Laravel.

## Installation

You can install the package via Composer:

```bash
composer require ryangjchandler/standalone-blade
```

## Usage

Begin by creating a new instance of the `RyanChandler\Blade\Blade` class.

```php
use RyanChandler\Blade\Blade;

$blade = new Blade('/path/to/views', '/path/to/cache');
```

You can now use the `Blade` object to interact with both the `Illuminate\View\Factory` instance and the `Illuminate\View\Compilers\BladeCompiler` instance.

```php
$html = $blade->make('my-view', ['name' => 'Ryan'])->render();

$blade->directive('echo', fn ($expression) => "<?php echo {$expression}; ?>");
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ryan Chandler](https://github.com/ryangjchandler)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
