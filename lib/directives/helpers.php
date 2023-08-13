<?php

return [
    /**
     * user.
     */
    'user' => static function () {
        return '<?php if (rex::getUser()) : ?>';
    },
    'enduser' => static function () {
        return '<?php endif; ?>';
    },
    'userid' => static function () {
        return '<?php echo rex::getUser()->getId() ?>';
    },
    'username' => static function () {
        return '<?php echo rex::getUser()->getName() ?>';
    },

    /**
     * environment.
     */
    'backend' => static function () {
        return '<?php if (rex::isBackend()) : ?>';
    },
    'endbackend' => static function () {
        return '<?php endif; ?>';
    },
    'frontend' => static function () {
        return '<?php if (rex::isFrontend()) : ?>';
    },
    'endfrontend' => static function () {
        return '<?php endif; ?>';
    },
    'debug' => static function () {
        return '<?php if (rex::isDebugMode()) : ?>';
    },
    'enddebug' => static function () {
        return '<?php endif; ?>';
    },
    'server' => static function () {
        return '<?php rex::getServer() ?>';
    },

    /**
     * properties.
     */
    'hasproperty' => static function ($key) {
        return "<?php if (rex::hasProperty({$key}) : ?>";
    },
    'endhasproperty' => static function () {
        return '<?php endif; ?>';
    },
    'property' => static function ($key) {
        return "<?php echo rex::getProperty({$key}) ?>";
    },

    /**
     * escape.
     */
    'escape' => static function ($expression) {
        $params = Blade::parseExpression($expression);

        $value = $params->get(0);
        $strategy = $params->get(1) ?? "'html'";

        return "<?php echo rex_escape({$value}, {$strategy}) ?>";
    },

    /**
     * string manipulation.
     */
    'kebab' => static function ($value) {
        return "<?php echo Illuminate\\Support\\Str::kebab({$value}); ?>";
    },
    'snake' => static function ($value) {
        return "<?php echo Illuminate\\Support\\Str::snake({$value}); ?>";
    },
    'camel' => static function ($value) {
        return "<?php echo Illuminate\\Support\\Str::camel({$value}); ?>";
    },
    'upper' => static function ($value) {
        return "<?php echo Illuminate\\Support\\Str::upper({$value}); ?>";
    },
    'lower' => static function ($value) {
        return "<?php echo Illuminate\\Support\\Str::lower({$value}); ?>";
    },

    /**
     * var_dump.
     */
    'vardump' => static function ($vars) {
        return "<?php echo '<pre>'; var_dump({$vars}); echo '</pre>' ?>";
    },

    /**
     * mix, eg. for TAR.
     */
    'mix' => static function ($path) {
        $manifestPath = rex_path::frontend('dist/mix-manifest.json');

        static $manifest;

        if (!$manifest) {
            if (!file_exists($manifestPath)) {
                throw new Exception('The Mix manifest does not exist.');
            }

            $manifest = json_decode(file_get_contents($manifestPath), true, 512, JSON_THROW_ON_ERROR);
        }

        if (!str_starts_with($path, '/')) {
            $path = "/{$path}";
        }

        if (!array_key_exists($path, $manifest)) {
            throw new Exception("Unable to locate Mix file: {$path}. Please check your " . 'webpack.mix.js output paths and try again.');
        }

        return rex_url::frontend('dist' . $manifest[$path]);
    },
];
