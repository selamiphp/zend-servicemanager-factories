<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Redis;

class RedisFactory implements FactoryInterface
{
    /**
     * @var Redis
     */
    private $redisClient;
    /**
     * @var array
     */
    private $config;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : Redis
    {
        $this->config = $container->get('config');
        $this->redisClient = new Redis();
        $connectionType = $this->config['redis']['connection'] ?? 'connect';
        $connectionType = in_array($connectionType, ['connect', 'pconnect'], true) ? $connectionType : 'connect';
        $this->{$connectionType}();
        $this->auth();
        $this->setOptions();
        $this->selectDb();
        return $this->redisClient;
    }

    private function connect()
    {
        $this->redisClient->connect(
            $this->config['redis']['host'],
            $this->config['redis']['port'] ?? null,
            $this->config['redis']['timeout'] ?? null,
            $this->config['redis']['reserved'] ?? null,
            $this->config['redis']['retry_interval'] ?? null
        );
    }

    private function pconnect()
    {
        $this->redisClient->pconnect(
            $this->config['redis']['host'],
            $this->config['redis']['port'] ?? null,
            $this->config['redis']['timeout'] ?? null,
            $this->config['redis']['persistent_id'] ?? null
        );
    }

    private function setOptions()
    {
        if (isset($this->config['redis']['options'])) {
            foreach ($this->config['redis']['options'] as $option) {
                $this->redisClient->setOption($option[0], $option[1]);
            }
        }
    }

    private function selectDb()
    {
        if (isset($this->config['redis']['select_db'])) {
            $this->redisClient->select((int) $this->config['redis']['select_db']);
        }
    }
    private function auth()
    {
        if (isset($this->config['redis']['auth']['password'])) {
            $this->redisClient->auth($this->config['redis']['auth']['password']);
        }
    }
}
