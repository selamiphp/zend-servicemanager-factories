<?php
declare(strict_types=1);

namespace Selami\Factories\Adapters\Symfony\Component\HttpFoundation\Session\Storage\Handler;

use Symfony\Component\HttpFoundation\Session\Storage\Handler;
use Redis;

class RedisSessionHandler implements \SessionHandlerInterface
{
    private $redis;
    private $ttl;
    private $prefix;

    public function __construct(Redis $redis, array $options = array())
    {
        $this->redis = $redis;
        if ($diff = array_diff(array_keys($options), array('prefix', 'expiretime'))) {
            throw new \InvalidArgumentException(sprintf(
                'The following options are not supported "%s"', implode(', ', $diff)
            ));
        }
        $this->ttl = isset($options['expiretime']) ? (int) $options['expiretime'] : 86400;
        $this->prefix = $options['prefix'] ?? 'selami';
    }

    public function open($savePath, $sessionName) : bool
    {
        return true;
    }

    public function close() : bool
    {
        return true;
    }

    public function read($sessionId) : string
    {
        return $this->redis->get($this->prefix.$sessionId) ?: '';
    }

    public function write($sessionId, $data) : bool
    {
        return $this->redis->set($this->prefix.$sessionId, $data, time() + $this->ttl);
    }

    public function destroy($sessionId)
    {
        return $this->redis->delete($this->prefix.$sessionId);
    }

    public function gc($maxlifetime) : bool
    {
        // not required here because redis will auto expire the records anyhow.
        return true;
    }

}