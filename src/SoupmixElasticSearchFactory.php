<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Elasticsearch\Client;
use Soupmix\Elasticsearch as SoupmixElasticsearch;

class SoupmixElasticSearchFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : SoupmixElasticsearch
    {
        $config = $container->get('config');
        return new SoupmixElasticsearch(
            $config['elasticsearch']['soupmix']['index_name'],
            $container->get(Client::class)
        );
    }
}
