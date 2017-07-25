<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Doctrine\DBAL\Connection;
use Soupmix\SQL;
use Soupmix\Base;

class SoupmixSQLFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : Base
    {
        $config = $container->get('config');
        return new SQL(
            $config['doctrine']['soupmix'],
            $container->get(Connection::class)
        );
    }
}
