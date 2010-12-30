<?php

namespace Bundle\BreadcrumbBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class BreadcrumbExtension extends Extension
{
    /**
     * Handles the breadcrumb configuration.
     *
     * @param  array $config The configuration being loaded
     * @param ContainerBuilder $container
     */
    public function configLoad(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
        $loader->load('breadcrumb.xml');

        
        if (isset($config['renderer']))
        {
            $container->setParameter('breadcrumb.renderer.class', $config['renderer']);
        }
        
        if (isset($config['template']))
        {
            $container->setParameter('breadcrumb.template.filename', $config['template']);
        }
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension\ExtensionInterface
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension\ExtensionInterface
     */
    public function getNamespace()
    {
        return 'http://www.symfony-project.org/schema/dic/breadcrumb';
    }

    /**
     * @see Symfony\Component\DependencyInjection\Extension\ExtensionInterface
     */
    public function getAlias()
    {
        return 'breadcrumb';
    }
}
