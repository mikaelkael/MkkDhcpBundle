<?php

namespace Mkk\DhcpBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('mkk_dhcp');
        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('leases')
                    ->children()
                        ->scalarNode('file')->cannotBeEmpty()->end()
                        ->scalarNode('throw_exception_on_parse_error')->defaultValue(true)->end()
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
