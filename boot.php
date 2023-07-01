<?php

/** @var \rex_addon $this */

rex_extension::register('PACKAGES_INCLUDED', static function () {
    rex::setProperty('bladeInstance', new Blade());
});

rex_extension::register('MODULE_ADDED', static function (rex_extension_point $extensionPoint) {
    $module = $extensionPoint->getParams();
    Blade::addModule($module);
});
