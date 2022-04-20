<?php

namespace VPyatin\Bundle\UserNamingBundle\EventListener;

use Oro\Bundle\UIBundle\Event\BeforeListRenderEvent;
use Oro\Bundle\UserBundle\Entity\User;

class UserViewNamingListener
{
    public function onUserView(BeforeListRenderEvent $event): void
    {
        /** @var User $user */
        $user = $event->getEntity();
        if (!($user instanceof User)) {
            return;
        }

        $template = $event->getEnvironment()->render(
            '@UserNaming/User/namingData.html.twig',
            ['entity' => $user]
        );

        $subBlockId = $event->getScrollData()->addSubBlock(0);
        $event->getScrollData()->addSubBlockData(0, $subBlockId, $template);
    }
}