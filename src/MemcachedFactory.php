<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Memcached;

class MemcachedFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : Memcached
    {
        $config = $container->get('config');
        $memcachedClient = new Memcached ($config['memcached']['bucket']);
        $memcachedClient->setOption(Memcached::OPT_LIBKETAMA_COMPATIBLE, true);
        $memcachedClient->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
        $memcachedClient->addServers($config['memcached']['hosts']);
        return $memcachedClient;
    }
}
