<?php

namespace VPyatin\Bundle\UserNamingBundle\Controller\Frontend;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

class NamingController extends AbstractController
{
    /**
     * @Route(
     *     "/",
     *     name="vpyatin_frontend_usernaming_index",
     * )
     *
     */
    public function indexAction(ContainerInterface $container)
    {
        $container->get('oro_config.user')->get('currency_exchange.api_url');
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedServices(): array
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                TranslatorInterface::class
            ]
        );
    }
}
