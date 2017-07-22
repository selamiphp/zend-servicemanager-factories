<?php
declare(strict_types=1);

namespace Selami\Factories;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Twig_Loader_Filesystem;
use Twig_Environment;

class TwigFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        $globals = $container->get('globals');
        $config['view']['templates_path'] = $config['app']['templates_path'];
        $loader = new Twig_Loader_Filesystem($config['view']['templates_path']);
        $twig = new Twig_Environment($loader, $config['view']['twig']);
        $twig->addGlobal('lang', $globals['runtime_lang']);
        return $twig;
    }
}
