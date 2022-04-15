<?php

namespace VPyatin\Bundle\PyatinThemeBundle\DependencyInjection;

use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;
use Oro\Bundle\FrontendBundle\DependencyInjection\OroFrontendExtension;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\HttpFoundation\Cookie;

class Configuration implements ConfigurationInterface
{
    const ALIAS = 'social_media_settings';

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::ALIAS);
        $rootNode = $treeBuilder->getRootNode();

        SettingsBuilder::append(
            $rootNode,
            [
                'instagram' => [
                    'type' => 'Symfony\Component\Form\Extension\Core\Type\UrlType',
                ],
                'facebook' => [
                    'type' => 'Symfony\Component\Form\Extension\Core\Type\UrlType',
                ],
                'twitter' => [
                    'type' => 'Symfony\Component\Form\Extension\Core\Type\UrlType',
                ],
            ]
        );

        return $treeBuilder;
    }
}
