<?php
// index.php

// Získáme URL adresu. Výchozí hodnota je '/' pro hlavní stranu.
$request_url = isset($_GET['url']) ? '/' . rtrim($_GET['url'], '/') : '/';

// Mapa vašich cest (Čistá URL => Fyzický soubor na serveru)
$routes = [
    '/'       => 'page/home.php',
    '/detail'       => 'page/book-detail.php',
    '/genrePage'       => 'page/genrePage.php',
    '/admin'       => 'admin-folder/admin-home.php',
    '/admin/books-manager'       => 'admin-folder/book-manager.php',
    '/admin/addBook'       => 'admin-folder/addBook.php',
    '/admin/readers'       => 'admin-folder/readers.php',
    '/admin/borrowed'       => 'admin-folder/borrowed.php',
    '/admin/settings'       => 'admin-folder/settings.php',
    '/login'   => 'public/login.php',
    '/register'  => 'public/register.php',
    '/cantLogIn'  => 'public/cantLogIn.php',
    '/accSettings'  => 'public/acc-settings.php',
    '/accDelete'  => 'public/acc-delete.php',
    '/cantLogIn-process'  => 'backend/cantLogIn-process.php',
    '/passwordReset'  => 'public/passwordReset.php',
    '/credits'  => 'page/credits.php',
    '/order'  => 'page/order.php',
    '/history'  => 'page/borrow-history.php',
];

// Zpracování cesty
if (array_key_exists($request_url, $routes)) {
    $target_file = $routes[$request_url];
    
    // Ochrana před chybějícím souborem
    if (file_exists($target_file)) {
        require $target_file;
    } else {
        http_response_code(500);
        echo "Chyba serveru: Šablona chybí.";
    }
} else {
    // Zde můžete načíst specifický soubor pro chybovou stránku
    http_response_code(404);
    echo "404 - Stránka nenalezena";
}