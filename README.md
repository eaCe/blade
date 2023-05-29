# :construction: WIP Blade Template Engine für REDAXO

Das Addon ermöglicht die Verwendung von Blade Templates in REDAXO.

## Verwendung

Um Blade Templates verwenden zu können, müssen diese innerhalb von Modulen oder Templates initialisiert werden.
Hierfür wird die Methode `Blade::make()` verwendet. Diese Methode erwartet als Parameter den Pfad zur Blade Datei und gegebenenfalls ein Array mit Variablen, die an das Template übergeben werden sollen. Unterordner können mit einem Punkt getrennt werden.

```php
echo Blade::make('modules.mymodule.blade.php', ['foo' => 'bar']);
```

Die Templates werden im `data/addons/blade/views` Verzeichnis abgelegt.

## Directives

Folgende zusätzliche Blade Directives werden unterstützt:

#### Article

```blade
// same as REX_ARTICLE[]
@article
@article(id=1, clang=1, ctype=1)

// returns the current article id
@articleId

// returns the current article name
@articleName
```

#### Helpers REDXAO

```blade
@user
    // user is logged in
@enduser

// returns the current user id
@userId 

@backend
    // environment is backend
@endbackend

@frontend
    // environment is frontend
@endfrontend
```

#### Helpers strings

```blade
// hello-world
@kebab('Hello World')

// hello_world
@snake('Hello World')

// helloWorld
@camel('Hello World')

// HELLOWORLD
@upper('Hello World')

// helloworld
@lower('Hello World')
```

#### Helpers development

```blade
// dump variable
@dump($var)

// dump variable and die
@dd($var)

// var_dump variable with <pre> tag
@vardump($var)
```

## Credits

- ryangjchandler - [standalone-blade](https://github.com/ryangjchandler/standalone-blade)