<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Selami\Router;
use Selami\Foundation\App;

class SelamiApplicationFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : App
    {
        return new App($container->get('config')['app'], $container->get(Router::class), $container);
    }
}
