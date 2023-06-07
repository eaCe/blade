<?php

return [
    'categoryid' => static function () {
        return '<?php echo rex_category::getCurrent()->getId() ?>';
    },
    'categoryname' => static function ($categoryId = null) {
        if ($categoryId) {
            return "<?php echo rex_category::get($categoryId)->getName() ?>";
        }

        return '<?php echo rex_article::getCurrent()->getName() ?>';
    },
];
