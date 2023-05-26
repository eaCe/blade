<?php

use Illuminate\Support\Str;

return [
    /**
     * user
     */
    'user' => static function () {
        return "<?php if (rex::getUser()) : ?>";
    },
    'enduser' => static function () {
        return "<?php endif; ?>";
    },
    'userId' => static function () {
        return "<?php echo rex::getUser()->getId() ?>";
    },


    /**
     * environment
     */
    'backend' => static function () {
        return "<?php if (rex::isBackend()) : ?>";
    },
    'endbackend' => static function () {
        return "<?php endif; ?>";
    },
    'frontend' => static function () {
        return "<?php if (rex::isFrontend()) : ?>";
    },
    'endfrontend' => static function () {
        return "<?php endif; ?>";
    },

    /**
     * string manipulation
     */
    'kebab' => static function ($value) {
        return '<?php echo ' . Str::kebab($value) . '; ?>';
    },
    'snake' => static function ($value) {
        return '<?php echo ' . Str::snake($value) . '; ?>';
    },
    'camel' => static function ($value) {
        return '<?php echo ' . Str::camel($value) . '; ?>';
    },
    'upper' => static function ($value) {
        return '<?php echo ' . Str::upper($value) . '; ?>';
    },
    'lower' => static function ($value) {
        return '<?php echo ' . Str::lower($value) . '; ?>';
    },

    /**
     * dump, dump and die
     */
    'dump' => static function ($vars) {
        return "<?php dump({$vars}); ?>";
    },

    'dd' => static function ($vars) {
        return "<?php dd({$vars}); ?>";
    },
];