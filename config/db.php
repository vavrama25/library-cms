<?php
/* SKOLA
	define('DB_NAME', 'vavrama25');
	define('DB_USER', 'vavrama25');
	define('DB_PASSWORD', 'Ff83zmQt');
	define('DB_HOST', '127.0.0.1');
*/
/*LOCAL

*/
	define('DB_NAME', 'cms-martin');
	define('DB_USER', '');
	define('DB_PASSWORD', '');
	define('DB_HOST', '127.0.0.1');
	global $db;

    $db = new PDO(
            "mysql:host=" .DB_HOST. ";dbname=" .DB_NAME. ";charset=utf8mb4",DB_USER,DB_PASSWORD,
          );
?>