<?php

describe('get', function () {
    it('should compile the get directive correctly', function () {
        $directive = '@get("test")';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_get("test", \'\', \'\') ?>');
    });

    it('should compile the get directive with arguments correctly', function () {
        $directive = '@get("test", "int", 1)';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_get("test", "int", 1) ?>');
    });
});

describe('post', function () {
    it('should compile the post directive correctly', function () {
        $directive = '@post("test")';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_post("test", \'\', \'\') ?>');
    });

    it('should compile the post directive with arguments correctly', function () {
        $directive = '@post("test", "int", 1)';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_post("test", "int", 1) ?>');
    });
});

describe('request', function () {
    it('should compile the request directive correctly', function () {
        $directive = '@request("test")';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_request("test", \'\', \'\') ?>');
    });

    it('should compile the request directive with arguments correctly', function () {
        $directive = '@request("test", "int", 1)';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_request("test", "int", 1) ?>');
    });
});

describe('reqestmethod', function () {
    it('should compile the requestmethod directive correctly', function () {
        $directive = '@requestmethod';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_request_method() ?>');
    });
});