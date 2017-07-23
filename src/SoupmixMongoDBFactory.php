<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use MongoDB\Client;
use Soupmix\MongoDB;

class SoupmixMongoDBFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        return new MongoDB(
            $config['mongodb']['soupmix'],
            $container->get(Client::class)
        );
    }
}
