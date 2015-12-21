<?php

namespace TwwDoctrineFreeTds\DBAL\Driver\PdoFreeTdsOdbc;

use Doctrine\DBAL\Driver\PDOConnection;
use Doctrine\DBAL\Driver\Connection as ConnectionInterface;

/**
 * PDOFreeTDS Connection implementation
 */
class Connection extends PDOConnection implements ConnectionInterface
{

    private $_isDriverLastInsertIdCapable = null;

    /**
     * {@inheritdoc}
     */
    public function getServerVersion()
    {
        // PDO::getAttribute causes an error, and I haven't worked out how to get the actual server version yet, so hardcode ALL THE THINGS!
        return '1.0.0.0';
    }

    /**
     * @override
     */
    public function quote($value, $type = \PDO::PARAM_STR)
    {
        $val = parent::quote($value, $type);

        // This is a well-known fix for buggy drivers yoinked from Doctrine's distributed SQL Server driver classes
        $val = rtrim($val, "\0");

        return $val;
    }

    private function isDriverLastInsertIdCapable()
    {
        if ($this->_isDriverLastInsertIdCapable !== null) {
            return $this->_isDriverLastInsertIdCapable;
        }

        $success = true;
        try {
            parent::lastInsertId();
        } catch (\Exception $e) {
            $success = false;
        }

        $this->_isDriverLastInsertIdCapable = $success;

        return $this->_isDriverLastInsertIdCapable;
    }

    /**
     * {@inheritdoc}
     */
    public function lastInsertId($name = null) {
        $id = null;

        if ($this->isDriverLastInsertIdCapable()) {
            return parent::lastInsertId();
        } else {
            // Props to Nick Barton for this haque http://php.net/manual/en/pdo.lastinsertid.php#110977
            $statement = $this->query("SELECT CAST(COALESCE(SCOPE_IDENTITY(), @@IDENTITY) AS int)");
            $statement->execute();

            $result = $statement->fetch();
            if ($result && is_array($result) && isset($result[0])) {
                $id = $result[0];
            }
        }

        return $id;
    }

}
