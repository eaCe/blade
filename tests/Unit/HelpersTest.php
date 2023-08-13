<?php

describe('@user', function () {
    it('should compile the user directive correctly', function () {
        $directive = '@user()';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php if (rex::getUser()) : ?>');
    });

    it('should compile the enduser directive correctly', function () {
        $directive = '@enduser()';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php endif; ?>');
    });

    it('should compile the userid directive correctly', function () {
        $directive = '@userid()';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex::getUser()->getId() ?>');
    });

    it('should compile the username directive correctly', function () {
        $directive = '@username()';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex::getUser()->getName() ?>');
    });
});
