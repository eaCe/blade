<?php
return [
    'get' => static function ($expression) {
        $params = Blade::parseExpression($expression);

        $key = $params->get(0);
        $varType = $params->get(1) ?? "''";
        $default = $params->get(2) ?? "''";

        return "<?php echo rex_get({$key}, {$varType}, {$default}) ?>";
    },
    'post' => static function ($expression) {
        $params = Blade::parseExpression($expression);

        $key = $params->get(0);
        $varType = $params->get(1) ?? "''";
        $default = $params->get(2) ?? "''";

        return "<?php echo rex_post({$key}, {$varType}, {$default}) ?>";
    },
    'request' => static function ($expression) {
        $params = Blade::parseExpression($expression);

        $key = $params->get(0);
        $varType = $params->get(1) ?? "''";
        $default = $params->get(2) ?? "''";

        return "<?php echo rex_request({$key}, {$varType}, {$default}) ?>";
    },
    'requestmethod' => static function () {
        return "<?php echo rex_request_method() ?>";
    },
];
