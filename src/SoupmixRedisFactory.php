<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Redis;
use Soupmix\Cache\RedisCache;
use Psr\SimpleCache\CacheInterface;


class SoupmixRedisFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : CacheInterface
    {
        $client = $container->get(Redis::class);
        return new RedisCache($client);
    }
}
