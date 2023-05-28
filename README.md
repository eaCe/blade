# :construction: WIP Blade Template Engine für REDAXO

Das Addon ermöglicht die Verwendung von Blade Templates in REDAXO.

## Directives

Folgende zusätzliche Blade Directives werden unterstützt:

**Helpers REDXAO**

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

**Helpers strings**

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

**Helpers development**

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