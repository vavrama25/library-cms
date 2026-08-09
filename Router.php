<?php
class Router {
    private array $routes = [];

    public function add(string $method, string $path, callable|array $callback): void {
        // Převod cesty s parametry (např. /kniha/{id}) na regulární výraz
        $path = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $path);
        $path = "#^" . $path . "$#";

        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function dispatch(string $uri, string $requestMethod): void {
        // Odstranění query stringu (to, co je za otazníkem v URL)
        $uri = parse_url($uri, PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && preg_match($route['path'], $uri, $matches)) {
                // Vyfiltrování pouze pojmenovaných parametrů z regulárního výrazu
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Zavolání callbacku a předání parametrů
                call_user_func_array($route['callback'], $params);
                return;
            }
        }

        // Fallback pro chybějící stránku
        http_response_code(404);
        echo "404 - Stránka nenalezena";
    }
}
?>