<?php

namespace Mkk\DhcpBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class MkkDhcpExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('mkk_dhcp.hosts.file', $config['hosts']['file']);
        $container->setParameter('mkk_dhcp.leases.file', $config['leases']['file']);
        $container->setParameter('mkk_dhcp.leases.throw_exception_on_parse_error', $config['leases']['throw_exception_on_parse_error']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yml');
    }
}
