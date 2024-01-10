<?php

describe('article', function () {
    it('should compile the article directive correctly', function () {
        $directive = '@article';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo (new rex_article_content(rex_article::getCurrentId()))->getArticle(); ?>');
    });

//     it('should compile the article directive with arguments correctly', function () {
//         $directive = "@article(1, 2, 3)";
//
//         $compiled = $this->compile($directive);
//
/*         expect($compiled)->toEqual('<?php echo (new rex_article_content(1, 3, 2))->getArticle(); ?>');*/
//    });

    it('should compile the articleid directive correctly', function () {
        $directive = '@articleid';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_article::getCurrentId() ?>');
    });

    it('should compile the articlename directive correctly', function () {
        $directive = '@articlename';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_article::getCurrent()->getName() ?>');
    });

    it('should compile the articlename directive with arguments correctly', function () {
        $directive = "@articlename(1)";

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual("<?php echo rex_article::get(1)->getName() ?>");
    });

    it('should compile the articleurl directive correctly', function () {
        $directive = '@articleurl';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_article::getCurrent()->getUrl() ?>');
    });

    it('should compile the articleurl directive with arguments correctly', function () {
        $directive = "@articleurl(1)";

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual("<?php echo rex_article::get(1)->getUrl() ?>");
    });
});