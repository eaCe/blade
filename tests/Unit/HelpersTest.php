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
});
