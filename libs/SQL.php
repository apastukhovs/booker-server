<?php
/**
 * Performs queries to the database
 */
class SQL
{
    private $link;
    private $sql;
    private $dsn;
    private $username;
    private $password;
    /**
     * Constructor, invokes connection to the database
     */
    function __construct()
    {
        $this->connect();    
    }
    /**
     * Performs a connection to the database
     */
    function connect()
    {
        try 
        {
            $link = new PDO($this->getDsn(), $this->getUsername(), $this->getPassword());
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setLink($link);
        }catch (PDOException $e) 
        {
            throw new Exception('Connection error: ' . $e->getMessage());
        }
    }
    /**
     * Performs a select query
     */
    function select()
    {
        try
        {
            $res = $this->link->query($this->sql);
        }catch(Exception $e)
        {
            $msg = "Error in query \n\"".$this->sql."\"\n: ".$e->getMessage();
            throw new Exception($msg);
        }
        return $res;
    }
    /**
     * Performs an insert query
     */
    function insert($params)
    {
        $this->prepStmt($params);
    }
    /**
     * Performs an update query
     */
    function update($params)
    {
        $this->prepStmt($params);
    }
    /**
     * Performs a delete query
     */
    function delete($params)
    {
        $this->prepStmt($params);
    }
    /**
     * Performs a prepared statement for the query
     */
    private function prepStmt($params)
    {
        if ($params && is_array($params))
        {
            try
            {
                $statement = $this->link->prepare($this->sql);
                $statement->execute($params);
            }catch(Exception $e)
            {
                throw new Exception("Error in query \n\"".$this->sql."\"\n: ".$e->getMessage());
            }
        }    
    }
    /**
     * Checks if the parameter is a string
     */
    function validString($str)
    {
        if ($str && is_string($str))
        {
            return true;
        }else
        {
            return false;
        }
    }
    /**
     * Stores a sql query
     */
    function setSql($sql)
    {
        $this->sql = $sql;
    }
    /**
     * Returns the sql query
     */
    function getSql()
    {
        return $this->sql;
    }
    function setLink($link)
    {
        $this->link = $link;
    }
    function getLink()
    {
        return $this->link;
    }
    function setUsername($username)
    {
        if ($this->validString($username))
        {
            $this->username = $username;
        }
        else
        {
            throw new Exception('username is not valid!');
        }
    }
    function getUsername()
    {
        return $this->username;
    }
    function setPassword($password)
    {
        if ($this->validString($password))
        {
            $this->password = $password;
        }
        else
        {
            throw new Exception('password is not valid!');
        }
    }
    function getPassword()
    {
        return $this->password;
    }
    function setDsn($dsn)
    {
        $this->dsn = $dsn;
    }
    function getDsn()
    {
        return $this->dsn;
    }
}