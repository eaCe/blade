<?php

/** @var \rex_addon $this */

rex_dir::copy(
    $this->getPath('templates'),
    $this->getDataPath()
);