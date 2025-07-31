<?php

namespace D07\Bundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class D07Extension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        // 1. Load the structure from Configuration.php
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // 2. Set the config values as container parameters
        $container->setParameter('d07.number', $config['number']);
        $container->setParameter('d07.enable', $config['enable']);

    }
}

?>