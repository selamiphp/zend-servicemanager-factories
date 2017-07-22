<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig_Environment;
use Selami\View\Twig\Twig as SelamiTwig;

class SelamiViewTwigFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        $request = $container->get(ServerRequestInterface::class);
        $config['view']['templates_path'] = $config['app']['templates_path'];
        $config['view']['runtime']['query_parameters'] =  $request->getParams();
        $config['view']['runtime']['base_url'] =  $config['app']['base_url'];
        $twig = $container->get(Twig_Environment::class);
        return new SelamiTwig($twig, $config['view']);
    }
}
