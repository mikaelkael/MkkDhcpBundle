<?php

namespace Mkk\DhcpBundle\Tests\Fixtures;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Used for functional tests.
 */
class TestKernel extends Kernel
{
    public function registerBundles(): iterable
    {
        return [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Mkk\DhcpBundle\MkkDhcpBundle()
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config.yml');
    }

    public function getCacheDir(): string
    {
        return $this->getProjectDir() . '/Tests/Fixtures/cache/' . $this->environment;
    }
}

class_alias('Mkk\DhcpBundle\Tests\Fixtures\TestKernel', 'TestKernel');
