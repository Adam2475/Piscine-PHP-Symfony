<?php

namespace D07\Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('D07');

        $rootNode
            ->children()
                ->integerNode('number')->isRequired()->end()
                ->booleanNode('enable')->defaultTrue()->end()
            ->end();

        return $treeBuilder;
    }
}

?>