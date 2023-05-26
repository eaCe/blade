<?php

return [
    'articleId' => static function () {
        return "<?php echo rex_article::getCurrentId() ?>";
    },
    'articleName' => static function ($articleId = null) {
        if ($articleId) {
            return "<?php echo rex_article::get($articleId)->getName() ?>";
        }

        return "<?php echo rex_article::getCurrent()->getName() ?>";
    },
];