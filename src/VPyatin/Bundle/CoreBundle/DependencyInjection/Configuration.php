<?php

namespace VPyatin\Bundle\CoreBundle\DependencyInjection;

use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;
use Oro\Bundle\FrontendBundle\DependencyInjection\OroFrontendExtension;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\HttpFoundation\Cookie;

class Configuration implements ConfigurationInterface
{
    /**#@+
     * Aliases
     */
    const ALIAS_CORE_SETTINGS = 'core_settings';
    const ALIAS_CURRENCY_EXCHANGE_API_URL = 'oro_ui.currency_exchange_api_url';
    /**#@-*/

    const CURRENCY_API_URL = 'https://api.monobank.ua';

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::ALIAS_CORE_SETTINGS);
        $rootNode = $treeBuilder->getRootNode();

        SettingsBuilder::append(
            $rootNode,
            [
                self::ALIAS_CURRENCY_EXCHANGE_API_URL => [
                    'type' => 'Symfony\Component\Form\Extension\Core\Type\UrlType',
                    'value' => self::CURRENCY_API_URL,
                ]
            ]
        );

        return $treeBuilder;
    }
}
