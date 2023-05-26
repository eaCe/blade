<?php

return [
    'articleId' => static function () {
        return "<?php echo rex_article::getCurrentId() ?>";
    },
    'articleName' => static function () {
        return "<?php echo rex_article::getCurrent()->getName() ?>";
    },
];