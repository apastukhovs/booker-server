<?php
include_once "SQL.php";
/**
 * Configures special settings for connecting to the database
 */
class MySQL extends SQL
{
    /**
     * Implements connection to the MySQL server
     */
    function connect()
    {
        $this->setDsn("mysql:host=".HOSTNAME.";dbname=".DBNAME);
        $this->setUsername(USERNAME);
        $this->setPassword(PASSWORD);
        parent::connect();
    }
}