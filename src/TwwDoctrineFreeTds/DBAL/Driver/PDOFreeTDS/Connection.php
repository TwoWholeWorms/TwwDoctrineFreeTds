<?php

namespace TwwDoctrineFreeTds\DBAL\Driver\PDOFreeTDS;

use Doctrine\DBAL\Driver\PDOConnection;

/**
 * PDOFreeTDS Connection implementation (basically, just needs a bog-standard PDOConnection AFAICT, but namespaced
 * for $reasons)
 */
class Connection extends PDOConnection implements \Doctrine\DBAL\Driver\Connection
{
    // …
}
