<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Selami\Router;

class RouterFactory implements FactoryInterface
{
    /**
     * @var array
     */
    private $routes;
    /**
     * @var Router
     */
    private $router;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var array $config
         */
        $config = $container->get('config');
        $this->routes = $container->get('routes');
        $request = $container->get(ServerRequestInterface::class);
        $this->router = new Router(
            $config['app']['default_return_type'] ?? Router::HTML,
            $request->getMethod(),
            $request->getUri()->getPath(),
            '',
            $config['app']['cache_file']
        );
        return $this->getRouter();
    }

    private function getRouter()
    {
        $this->addRoutes();
        return $this->router;
    }

    private function addRoutes()
    {
        foreach ($this->routes as $route) {
            $this->router->add($route[0], $route[1], $route[2], $route[3], $route[4] ?? '');
        }
    }
}
