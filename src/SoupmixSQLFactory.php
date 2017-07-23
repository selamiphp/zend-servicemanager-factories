<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Doctrine\DBAL\Connection;
use Soupmix\SQL;

class SoupmixSQLFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        return new SQL(
            $config['mongodb']['soupmix'],
            $container->get(Connection::class)
        );
    }
}
