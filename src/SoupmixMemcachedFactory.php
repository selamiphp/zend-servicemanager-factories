<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Memcached;
use Psr\SimpleCache\CacheInterface;
use Soupmix\Cache\MemcachedCache;

class SoupmixMemcachedFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : CacheInterface
    {
        $client = $container->get(Memcached::class);
        return new MemcachedCache($client);
    }
}
