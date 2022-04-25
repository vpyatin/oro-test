<?php

namespace VPyatin\Bundle\CoreBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use VPyatin\Bundle\CoreBundle\Entity\MonobankCurrencyInterface;

class CoreBundleInstaller implements Installation
{
    /**
     * @inheritDoc
     */
    public function getMigrationVersion(): string
    {
        return 'v1_0';
    }

    /**
     * @inheritDoc
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $schema->createTable(MonobankCurrencyInterface::TABLE_NAME);
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('currency_code_from_iso', 'currency', ['notnull' => true, 'length' => 3, 'comment' => '(DC2Type:currency)']);
        $table->addColumn('currency_code_to_iso', 'currency', ['notnull' => true,'length' => 3, 'comment' => '(DC2Type:currency)']);
        $table->addColumn('currency_code_from', 'string', ['notnull' => true, 'length' => 3]);
        $table->addColumn('currency_code_to', 'string', ['notnull' => true, 'length' => 3]);
        $table->addColumn('rate_sell', 'money', ['notnull' => false, 'comment' => '(DC2Type:money)']);
        $table->addColumn('rate_buy', 'money', ['notnull' => false, 'comment' => '(DC2Type:money)']);
        $table->addColumn('rate_cross', 'money', ['notnull' => false, 'comment' => '(DC2Type:money)']);
        $table->addColumn('currency_date', 'datetime', ['notnull' => true]);
        $table->addColumn('created_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
        $table->addColumn('updated_at', 'datetime', ['notnull' => true, 'default' => 'CURRENT_TIMESTAMP']);
        $table->setPrimaryKey(['id']);
    }
}