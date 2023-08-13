<?php

describe('@user', function () {
    it('should compile the user directive correctly', function () {
        $directive = '@user';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php if (rex::getUser()) : ?>');
    });

    it('should compile the enduser directive correctly', function () {
        $directive = '@enduser';

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

describe('environment', function () {
    it('should compile the backend directive correctly', function () {
        $directive = '@backend';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php if (rex::isBackend()) : ?>');
    });

    it('should compile the endbackend directive correctly', function () {
        $directive = '@endbackend';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php endif; ?>');
    });

    it('should compile the frontend directive correctly', function () {
        $directive = '@frontend';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php if (rex::isFrontend()) : ?>');
    });

    it('should compile the endfrontend directive correctly', function () {
        $directive = '@endfrontend';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php endif; ?>');
    });

    it('should compile the debug directive correctly', function () {
        $directive = '@debug';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php if (rex::isDebugMode()) : ?>');
    });

    it('should compile the enddebug directive correctly', function () {
        $directive = '@enddebug';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php endif; ?>');
    });

    it('should compile the server directive correctly', function () {
        $directive = '@server';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php rex::getServer(); ?>');
    });
});

describe('properties', function () {
    it('should compile the hasproperty directive correctly', function () {
        $directive = '@hasproperty("test")';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php if (rex::hasProperty("test")) : ?>');
    });

    it('should compile the endhasproperty directive correctly', function () {
        $directive = '@endhasproperty';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php endif; ?>');
    });

    it('should compile the property directive correctly', function () {
        $directive = '@property("test")';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex::getProperty("test"); ?>');
    });
});