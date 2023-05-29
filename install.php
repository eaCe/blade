<?php

/** @var \rex_addon $this */

if (!is_dir($this->getPath('templates'))) {
    rex_dir::copy(
        $this->getPath('templates'),
        $this->getDataPath()
    );
}
