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
    /** function to load menu */
        public function getMenuItems(){
            $sql = "SELECT * FROM menu ORDER BY menuorder";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    /**  load images to image gallery **/
    public function getImageItems(){
        $sql = "SELECT * FROM imagegallery ORDER BY idimage";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /** function to load changelog items for peeporun2d */
    public function getChangelogprItems(){
        $sql = "SELECT * FROM changelogpr ORDER BY version DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /** function to load changelog items for ra1glauncher */
    public function getChangelogrlItems(){
        $sql = "SELECT * FROM changelogrl ORDER BY version DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /** function to load changelog items for website */
    public function getChangelogsiteItems(){
        $sql = "SELECT * FROM changelogsite ORDER BY version DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Register($username, $password, $email)
    {
        try {
            $query = $this->connection->prepare("INSERT INTO users(username, password, email, role) VALUES (:username,:password,:email,'basic')");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $enc_password = hash('sha256', $password);
            $query->bindParam("password", $enc_password, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function UserDetails($id)
    {
        try {
            $query = $this->connection->prepare("SELECT userid, username, email, role FROM users WHERE userid=:userid");
            $query->bindParam("userid", $id, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function Login($username, $password)
    {
        try {
            $query = $this->connection->prepare("SELECT userid FROM users WHERE (username=:username OR email=:username) AND password=:password");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $enc_password = hash('sha256', $password);
            $query->bindParam("password", $enc_password, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                return $result->userid;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function isEmail($email)
    {
        try {
            $query = $this->connection->prepare("SELECT userid FROM users WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function isUsername($username)
    {
        try {
            $query = $this->connection->prepare("SELECT userid FROM users WHERE username=:username");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

}



?>