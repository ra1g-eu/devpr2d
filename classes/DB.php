<?php

namespace classes;

use PDO;
use PDOException;

class DB
{
    /**
     * @var string
     */
    private $host = "";
    /**
     * @var string
     */
    private $username = "";
    /**
     * @var string
     */
    private $password = "";
    /**
     * @var string
     */
    private $dbname = "";
    /**
     * @var int|mixed
     */
    private $port;
    /**
     * @var
     */
    private $connection;

    /**
     * DB constructor.
     * @param $host
     * @param $username
     * @param $password
     * @param $dbname
     * @param int $port
     */
    public function __construct($host, $username, $password, $dbname, $port = 3306)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->port = $port;

        try{
            $connection = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname.";port=".$this->port, $this->username, $this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection = $connection;
        } catch(PDOException $exception){
            echo "Error while connecting to DB". $exception->getMessage();

        }

    }

    /**
     * @return PDO
     */
    public function getConnection(){
        return $this->connection;
    }

    /**
     * @param $connectio
     */
    public function setConnection($connectio){
        if($connectio instanceof PDO){
            $this->connection = $connectio;
        }

    }
        public function getMenuItems(){
            $sql = "SELECT * FROM menu ORDER BY idmenu";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

}

?>