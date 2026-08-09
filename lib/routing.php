<?php

define('BASE_URL', '/martin/CMS/');

function url($path) {
    $path = ltrim($path, '/');
    return BASE_URL . $path;
}