<?php

namespace TwwDoctrineFreeTds\DBAL\Driver\PdoDblib;

use Doctrine\DBAL\Driver\AbstractSQLServerDriver;
use Doctrine\DBAL\Platforms\SQLServer2012Platform;

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
        $dsn = 'dblib:host=';

        if (isset($params['host'])) {
            $dsn .= $params['host'];
        }

        if (isset($params['port']) && !empty($params['port'])) {
            $dsn .= ';port=' . $params['port'];
        }

        if (isset($params['dbname'])) {
            $dsn .= ';dbname=' .  $params['dbname'];
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

}
