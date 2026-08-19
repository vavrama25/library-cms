<?php
if (!defined('BASE_DIR')) {
    define('BASE_DIR', dirname(dirname(__FILE__)) . '/');
}


include_once(BASE_DIR . 'config/db.php');
include_once(BASE_DIR . 'lib/development.php');
include_once(BASE_DIR . 'lib/verify.php');
include_once(BASE_DIR . 'lib/hash.php');
include_once(BASE_DIR . 'lib/db_changes.php');
include_once(BASE_DIR . 'lib/other.php');
include_once(BASE_DIR . 'lib/passReset.php');
include_once(BASE_DIR . 'lib/admin.php');
include_once(BASE_DIR . 'lib/routing.php');
include_once(BASE_DIR . 'lib/cms-settings.php');
include_once(BASE_DIR . 'lib/components.php');
include_once(BASE_DIR . 'lib/admin-components.php');
global $db;
?>