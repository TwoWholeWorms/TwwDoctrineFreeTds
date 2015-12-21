<?php

namespace TwwDoctrineFreeTds\DBAL\Driver\PdoFreeTdsOdbc;

use Doctrine\DBAL\Connection as DoctrineConnection;
use Doctrine\DBAL\Driver\AbstractSQLServerDriver;
use Doctrine\DBAL\Platforms\SQLServer2012Platform;
use Doctrine\DBAL\Schema\SQLServerSchemaManager;

/**
 * The PDO-based Sqlsrv driver.
 *
 * @since 2.0
 */
class Driver extends AbstractSQLServerDriver
{

    /**
     * {@inheritdoc}
     */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = array())
    {
        return new Connection(
            $this->_constructPdoDsn($params),
            $username,
            $password,
            $driverOptions
        );
    }

    /**
     * Constructs the Sqlsrv ODBC PDO DSN.
     *
     * @param array $params
     *
     * @return string The DSN.
     */
    private function _constructPdoDsn(array $params)
    {
        $dsn = 'odbc:driver=FreeTDS;Server=';

        if (isset($params['host'])) {
            $dsn .= $params['host'];
        }

        if (isset($params['port']) && !empty($params['port'])) {
            $dsn .= ';Port=' . $params['port'];
        }

        if (isset($params['dbname'])) {
            $dsn .= ';dbname=' .  $params['dbname'];
        }

        if (isset($params['user'])) {
            $dsn .= ';UID=' .  $params['user'];
        }

        if (isset($params['password'])) {
            $dsn .= ';PWD=' .  $params['password'];
        }

        return $dsn;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pdo_freetds';
    }

    /**
     * {@inheritdoc}
     */
    public function getDatabasePlatform()
    {
        return new SQLServer2012Platform();
    }

    /**
     * {@inheritdoc}
     */
    public function getSchemaManager(DoctrineConnection $conn)
    {
        return new SQLServerSchemaManager($conn);
    }

}
