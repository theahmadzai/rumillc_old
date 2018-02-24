<?php

class App
{
    private $base_path;
    private $views_path;
    private $uri;
    private $routes = [];

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri    = $_SERVER['REQUEST_URI'];
    }

    public function basePath(string $path = '')
    {
        if (empty($path)) {
            return $this->base_path;
        }

        $this->base_path = '/' . trim($path, '/');
    }

    public function viewsPath(string $path = '')
    {
        if (empty($path)) {
            return $this->views_path;
        }

        $this->views_path = trim($path, '/');
    }

    public function map(string $pattern, callable $callback)
    {
        $this->routes[] = [trim($pattern, '/'), $callback];
    }

    public function dispatch()
    {
        $this->match($this->uri);
    }

    private function match(string $uri)
    {
        $request = $this->resolve($uri);

        foreach ($this->routes as $route) {
            list($pattern, $callback) = $route;
            $pattern                  = explode('/', trim($pattern, '/'));
            $page                     = $pattern[0];
            unset($pattern[0]);
            $params = $pattern;

            if ($request['page'] === $page) {
                if (count($params) === count($request['params'])) {

                    $params = array_combine($params, $request['params']);

                    $post = !empty($_POST) ? $_POST : [];

                    return $callback($params, $this->method, $post);
                }
            }
        }

        header('HTTP/1.1 404 Not Found');

        return $this->render('404');
    }

    private function resolve(string $uri)
    {
        $uri = trim($uri, '/');
        $uri = substr($uri, strlen($this->basePath()));
        $uri = explode('/', trim($uri, '/'));

        $params         = [];
        $params['page'] = $uri[0];
        unset($uri[0]);
        $params['params'] = array_values($uri);

        return $params;
    }

    public function render(string $page, $params = [], $db = null)
    {
        $data      = (array) $params;
        $viewsPath = $this->viewsPath();
        $basePath  = $this->basePath();
        $page      = trim($page, '/');
        require $viewsPath . '/' . $page . '.php';
    }

    public function redirect(string $page)
    {
        $viewsPath = $this->viewsPath();
        $basePath  = $this->basePath();
        echo $basePath;
        header("HTTP/1.1 301 Moved Permanently");
        header('Location:' . $basePath . $page);
    }
}
