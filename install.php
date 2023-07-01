<?php

/** @var \rex_addon $this */

if (!is_dir($this->getDataPath('views'))) {
    rex_dir::copy(
        $this->getPath('templates'),
        $this->getDataPath(),
    );
}
