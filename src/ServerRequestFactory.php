<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Selami\Http\ServerRequestFactory as SelamiServerRequestFactory;
use Psr\Http\Message\ServerRequestInterface;

class ServerRequestFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : ServerRequestInterface
    {
        return SelamiServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
    }
}
