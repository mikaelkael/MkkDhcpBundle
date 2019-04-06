<?php

namespace Mkk\DhcpBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mkk_dhcp');

        $rootNode
            ->children()
                ->arrayNode('leases')
                    ->children()
                        ->scalarNode('file')->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('hosts')
                    ->children()
                        ->scalarNode('file')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
