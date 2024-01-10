<?php

describe('category', function () {
    it('should compile the categoryid directive correctly', function () {
        $directive = "@categoryid";

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_category::getCurrent()->getId() ?>');
    });

    it('should compile the categoryname directive correctly', function () {
        $directive = "@categoryname";

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_category::getCurrent()->getName() ?>');
    });

    it('should compile the categoryname directive with arguments correctly', function () {
        $directive = "@categoryname(1)";

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual("<?php echo rex_category::get(1)->getName() ?>");
    });
});