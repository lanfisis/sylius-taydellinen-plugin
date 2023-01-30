<?php

declare(strict_types=1);

namespace MonsieurBiz\SyliusTaydellinenPlugin\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

final class MonsieurBizSyliusTaydellinenExtension extends Extension implements PrependExtensionInterface
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');
    }

    public function getAlias(): string
    {
        return str_replace('monsieur_biz', 'monsieurbiz', parent::getAlias());
    }

    /**
     * This part is overwrite for the moment due to the `performNoDeepMerging` line 48 in
     * `\Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition::performNoDeepMerging`
     */
    public function prepend(ContainerBuilder $container): void
    {
        $bundles = $container->getParameter('kernel.bundles');
        if (false === \is_array($bundles) || !isset($bundles['SyliusThemeBundle'])) {
            return;
        }
        $container->prependExtensionConfig('sylius_theme', ['sources' => ['filesystem' => ['directories' => [
            '%kernel.project_dir%/vendor/monsieurbiz/sylius-taydellinen-plugin/theme'
        ]]]]);
    }
}
