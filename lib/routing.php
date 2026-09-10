<?php

define('BASE_URL', '/');

function url($path) {
    $path = ltrim($path, '/');
    return BASE_URL . $path;
}
