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
    'userId' => static function () {
        return '<?php echo rex::getUser()->getId() ?>';
    },
    'userName' => static function () {
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

    /**
     * string manipulation.
     */
    'kebab' => static function ($value) {
        return "<?php echo Illuminate\Support\Str::kebab({$value}); ?>";
    },
    'snake' => static function ($value) {
        return "<?php echo Illuminate\Support\Str::snake({$value}); ?>";
    },
    'camel' => static function ($value) {
        return "<?php echo Illuminate\Support\Str::camel({$value}); ?>";
    },
    'upper' => static function ($value) {
        return "<?php echo Illuminate\Support\Str::upper({$value}); ?>";
    },
    'lower' => static function ($value) {
        return "<?php echo Illuminate\Support\Str::lower({$value}); ?>";
    },

    /**
     * dump, dump and die, var_dump.
     */
    'dump' => static function ($vars) {
        return "<?php dump({$vars}); ?>";
    },
    'dd' => static function ($vars) {
        return "<?php dd({$vars}); ?>";
    },
    'vardump' => static function ($vars) {
        return "<?php echo '<pre>'; var_dump({$vars}); echo '</pre>' ?>";
    },
];
