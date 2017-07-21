<?php
declare(strict_types=1);

namespace SelamiApp\Factories;

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
        $loader = new Twig_Loader_Filesystem($config['app']['templates_path']);
        $twig = new Twig_Environment($loader, $config['app']['twig']);
        $twig->addGlobal('lang', $globals['runtime_lang']);
        return $twig;
    }
}
