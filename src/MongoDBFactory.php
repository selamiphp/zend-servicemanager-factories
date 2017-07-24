<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use MongoDB\Client;

class MongoDBFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : Client
    {
        $config = $container->get('config');
        return new Client(
            $config['mongodb']['uri'],
            $config['mongodb']['uriOptions'] ?? null,
            $config['mongodb']['driverOptions'] ?? null
        );
    }
}
