<?php

namespace VPyatin\Bundle\CoreBundle\Config;

use Oro\Bundle\ConfigBundle\Config\AbstractScopeManager;

class CoreSettingsManager extends AbstractScopeManager
{
    public const SCOPED_ENTITY_NAME = 'core_settings';

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