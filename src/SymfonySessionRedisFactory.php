<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Selami\Factories\Adapters\Symfony\Component\HttpFoundation\Session\Storage\Handler\RedisSessionHandler;
use Symfony\Component\HttpFoundation\Session\Session;
use Memcached;

class SymfonySessionRedisFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : Session
    {
        ini_set('session.use_cookies', '1');
        ini_set('session.use_only_cookies', '1');
        ini_set('session.cookie_httponly', '1');
        ini_set('session.name', 'SELAMISESSID');
        $storage = new NativeSessionStorage(array(), new RedisSessionHandler($container->get(Redis::class)));
        return new Session($storage);
    }
}
