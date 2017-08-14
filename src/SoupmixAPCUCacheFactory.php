<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;
use Soupmix\Cache\APCUCache;

class SoupmixAPCUCacheFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : CacheInterface
    {
        return new APCUCache();
    }
}
