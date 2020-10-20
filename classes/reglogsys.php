<?php


namespace classes;

use PDO;
use PDOException;
use classes\DB;
class reglogsys
{

    /*
    * Register New User
    *
    * @param $name, $email, $username, $password
    * @return ID
    * */
    public function Register($email, $username, $password)
{
    try {
        $db = DB();
        $query = $db->prepare("INSERT INTO users(username, password, email, role) VALUES (:username,:password,:email,'basic')");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $enc_password = hash('sha256', $password);
        $query->bindParam("password", $enc_password, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        return $db->lastInsertId();
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}

    /*
     * Check Username
     *
     * @param $username
     * @return boolean
     * */


    /*
     * Check Email
     *
     * @param $email
     * @return boolean
     * */


    /*
     * Login
     *
     * @param $username, $password
     * @return $mixed
     * */


    /*
     * get User Details
     *
     * @param $user_id
     * @return $mixed
     * */

}