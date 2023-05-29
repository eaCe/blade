<?php

/** @var \rex_addon $this */

rex_extension::register('PACKAGES_INCLUDED', static function () {
    rex::setProperty('bladeInstance', new Blade());
});
