<?php

namespace VPyatin\Bundle\CoreBundle\Provider;

use Oro\Bundle\ConfigBundle\Config\Tree\GroupNodeDefinition;
use Oro\Bundle\ConfigBundle\Provider\AbstractProvider;

class CoreSettingsFormProvider extends AbstractProvider
{
    public const TREE_NAME = 'core_settings';

    /**
     * @inheritDoc
     */
    protected function getParentCheckboxLabel(): string
    {
        return 'oro.config.system_configuration.use_default';
    }

    /**
     * @inheritDoc
     */
    public function getTree(): GroupNodeDefinition
    {
        return $this->getTreeData(self::TREE_NAME, self::CORRECT_FIELDS_NESTING_LEVEL);
    }

    /**
     * @inheritDoc
     */
    public function getJsTree(): array
    {
        return $this->getJsTreeData(self::TREE_NAME, self::CORRECT_MENU_NESTING_LEVEL);
    }
}