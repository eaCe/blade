<?php
return [
    'translate' => static function ($key) {
        return '<?php echo rex_i18n::msg($key) ?>';
    },
];
