<?php

namespace TwwDoctrineFreeTds\DBAL\Driver\PDOFreeTDS;

use Doctrine\DBAL\Driver\PDOConnection;

/**
 * PDOFreeTDS Connection implementation
 */
class Connection extends PDOConnection implements \Doctrine\DBAL\Driver\Connection
{

    /**
     * {@inheritdoc}
     */
    public function getServerVersion()
    {
        return 'Microsoft SQL Server';
    }

}
