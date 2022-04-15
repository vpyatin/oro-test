<?php

namespace VPyatin\Bundle\PyatinThemeBundle\Config;

use Oro\Bundle\ConfigBundle\Config\AbstractScopeManager;

class SocialMediaSettingsManager extends AbstractScopeManager
{
    public const SCOPED_ENTITY_NAME = 'social_media_settings';

    /**
     * @inheritDoc
     */
    public function getScopedEntityName(): string
    {
        return self::SCOPED_ENTITY_NAME;
    }

    /**
     * @inheritDoc
     */
    public function getScopeId(): int
    {
        return 0;
    }
}