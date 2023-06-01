<?php

return [
    'categoryId' => static function () {
        return '<?php echo rex_category::getCurrent()->getId() ?>';
    },
    'categoryName' => static function ($categoryId = null) {
        if ($categoryId) {
            return "<?php echo rex_category::get($categoryId)->getName() ?>";
        }

        return '<?php echo rex_article::getCurrent()->getName() ?>';
    },
];
