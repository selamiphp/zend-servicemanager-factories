<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig_Environment;
use Selami\View\Twig\Twig as SelamiTwig;
use Selami\View\ViewInterface;

class SelamiViewTwigFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : ViewInterface
    {
        $config = $container->get('config');
        $request = $container->get(ServerRequestInterface::class);
        $viewConfig = $config['view'];
        $viewConfig['templates_path'] = $config['app']['templates_path'];
        $viewConfig['runtime']['query_parameters'] =  $request->getParams();
        $viewConfig['runtime']['base_url'] =  $config['app']['base_url'];
        $viewConfig['runtime']['config'] = $config;
        $twig = $container->get(Twig_Environment::class);
        return new SelamiTwig($twig, $viewConfig);
    }
}
