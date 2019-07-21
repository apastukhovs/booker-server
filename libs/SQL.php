<?
class SQL
{
    private $link;
    private $sql;
    private $dsn;
    private $username;
    private $password;

    function __construct()
    {
        $this->connect();    
    }

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

    function insert($params)
    {
        $this->prepStmt($params);
    }

    function update($params)
    {
        $this->prepStmt($params);
    }

    function delete($params)
    {
        $this->prepStmt($params);
    }

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

    function setSql($sql)
    {
        $this->sql = $sql;
    }

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