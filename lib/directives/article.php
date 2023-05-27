<?php

return [
    'article' => static function ($arguments) {
        if ('' === $arguments) {
            return '<?php echo (new rex_article_content(rex_article::getCurrentId()))->getArticle(); ?>';
        }

        $arguments = Blade::getParsedArgs($arguments);
        $id = $arguments['id'] ?? rex_article::getCurrentId();
        $clang = $arguments['clang'] ?? 'null';
        $ctype = $arguments['ctype'] ?? 'null';

        return '<?php echo (new rex_article_content($id, $ctype, $clang))->getArticle(); ?>';
    },
    'articleId' => static function () {
        return '<?php echo rex_article::getCurrentId() ?>';
    },
    'articleName' => static function ($articleId = null) {
        if ($articleId) {
            return "<?php echo rex_article::get($articleId)->getName() ?>";
        }

        return '<?php echo rex_article::getCurrent()->getName() ?>';
    },
];
