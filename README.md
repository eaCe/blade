# :construction: WIP Blade Template Engine für REDAXO

Das Addon ermöglicht die Verwendung von Blade Templates in REDAXO.

## Verwendung

Um Blade Templates verwenden zu können, müssen diese innerhalb von Modulen oder Templates initialisiert werden.
Hierfür wird die Methode `Blade::make()` verwendet. Diese Methode erwartet als Parameter den Pfad zur Blade Datei und gegebenenfalls ein Array mit Variablen, die an das Template übergeben werden sollen. Unterordner können mit einem Punkt getrennt werden.
Wird ein neues Modul ohne Output erstellt, wird der Code automatisch eingefügt. Der Name des View-Files wird automatisch aus dem Modulnamen oder Key abgeleitet.

```php
echo Blade::make('modules.mymodule', ['foo' => 'bar']);
```

Die Templates werden im `data/addons/blade/views` Verzeichnis abgelegt. Ist das Theme-Addon installiert, können die Templates auch im `public/theme/private/views` Verzeichnis abgelegt werden.

Weitere Informationen zur Verwendung von Blade Templates finden sich in der [Blade Dokumentation](https://laravel.com/docs/10.x/blade). Spezifische Laravel Funktionalitäten werden nicht unterstützt. X-Components werden (aktuell leider) nicht unterstützt.

Übergibt man innerhalb des Moduls den Modul-Kontext, bzw. rex_article_content, als `content` werden die Variablen automatisch an das Template übergeben und können unter dem jeweiligen Namen verwendet werden.

```php
echo Blade::make('modules.mymodule', ['content' => $this]);
```

```blade
<h1>{{ $value1 }}</h1>

<div class="wysiwyg">
    {!! $value2 !!}
</div>

<a href="@articleUrl($link1)">@articleName($link1)</a>
```

## Directives

Neben den Standard Blade Directives, die in der [Blade Dokumentation](https://laravel.com/docs/10.x/blade#blade-directives) beschrieben sind, werden untenstehende Directives unterstützt.

Eigene Directives können über den Extension Point `BLADE_DIRECTIVES` registriert werden. Beispiele hierfür finden sich im directives Verzeichnis.

#### Article

```blade
// same as REX_ARTICLE[]
@article
@article(id=1, clang=1, ctype=1)

// returns the current article id
@articleid

// returns the current or given article name
@articlename
@articlename(1)

// returns the current or given article url
@articleurl
@articleurl(1)
```

#### Article

```blade
// returns the current category id
@categoryid

// returns the current or given category name
@categoryname
@categoryname(1)
```

#### Media

```blade
// returns the path to the given media file
@mediasrc('filename.jpg')
```

#### Request

```blade
// same as rex_get()
@get('param_name')
@get('param_name', 'string')
@get('param_name', 'string', 'default value')

// same as rex_post()
@post('param_name')
@post('param_name', 'string')
@post('param_name', 'string', 'default value')

// same as rex_request()
@request('param_name')
@request('param_name', 'string')
@request('param_name', 'string', 'default value')

// returns the current request method
@requestMethod
```

#### Helpers REDXAO

```blade
@user
    // user is logged in
@enduser

// returns the current user id
@userid 

@backend
    // environment is backend
@endbackend

@frontend
    // environment is frontend
@endfrontend

@debug
    // debug is enabled
@enddebug

// returns the server URL
@server

// rex_i18n::msg($key)
@translate('key')

// rex_escape($value, $strategy = 'html')
@escape('value')
@escape('http://website.xyz', 'url')

// returns the property value of the given key
@property('key')

@hasproperty('key')
    // property exists
@endhasproperty
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