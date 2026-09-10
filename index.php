<?php
// index.php

// Získání čisté cesty z REQUEST_URI (odstraní query string ?id=30 a prefix podsložky)
$request_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base_path = '/';

if (strpos($request_path, $base_path) === 0) {
    $request_path = substr($request_path, strlen($base_path));
}

$request_url = '/' . trim($request_path, '/');
if ($request_url === '//' || $request_url === '') {
    $request_url = '/';
}

// Mapa vašich cest
$routes = [
    '/' => 'page/home.php',
    '/detail' => 'page/book-detail.php',
    '/genrePage' => 'page/genrePage.php',
    '/admin' => 'admin-folder/admin-home.php',
    '/admin/books-manager' => 'admin-folder/book-manager.php',
    '/admin/addBook' => 'admin-folder/addBook.php',
    '/admin/readers' => 'admin-folder/readers.php',
    '/admin/borrowed' => 'admin-folder/borrowed.php',
    '/admin/settings' => 'admin-folder/settings.php',
    '/login' => 'public/login.php',
    '/register' => 'public/register.php',
    '/cantLogIn' => 'public/cantLogIn.php',
    '/accSettings' => 'public/acc-settings.php',
    '/accDelete' => 'public/acc-delete.php',
    '/cantLogIn-process' => 'backend/cantLogIn-process.php',
    '/passwordReset' => 'public/passwordReset.php',
    '/credits' => 'page/credits.php',
    '/order' => 'page/order.php',
    '/history' => 'page/borrow-history.php',
];

// Zpracování cesty (zůstává stejné)
if (array_key_exists($request_url, $routes)) {
    $target_file = $routes[$request_url];

    if (file_exists($target_file)) {
        require $target_file;
    } else {
        http_response_code(500);
        echo "Chyba serveru: Šablona chybí.";
    }
} else {
    http_response_code(404);
    echo "404 - Stránka nenalezena";
}
