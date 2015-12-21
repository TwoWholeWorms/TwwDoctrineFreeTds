# TwoWholeWorms/TwwDoctrineFreeTds

This repo contains a Doctrine2 driver for SQL Server which uses FreeTDS to connect to the server via either ODBC or DBlib. It
was written to connect a ZF2 project I maintain to SQL Server databases as Doctrine2 doesn't natively support PDO ODBC
connections, and the PDOSqlsrv driver uses the sqlsrv: protocol, which isn't supported on Linux.

As always, install with composer:

 php composer.phar require twowholeworms/tww-doctrine-freetds dev-devel
