<?php

describe('@translate', function () {
    it('should compile the translate directive correctly', function () {
        $directive = '@translate("test")';

        $compiled = $this->compile($directive);

        expect($compiled)->toEqual('<?php echo rex_i18n::msg("test") ?>');
    });
});
