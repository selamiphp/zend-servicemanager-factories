<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Client;

class ElasticsearchFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : Client
    {
        $config = $container->get('config');
        return ClientBuilder::create()->setHosts($config['elasticsearch']['hosts'])->build();
    }
}
