<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-03-31
 * Time: 09:30
 */

namespace Game;


class Site
{
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param string $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * @return string
     */
    public function getTablePrefix()
    {
        return $this->tablePrefix;
    }

    /**
     * Configure the database
     * @param $host
     * @param $user
     * @param $password
     * @param $prefix
     */
    public function dbConfigure($host, $user, $password, $prefix) {
        $this->dbHost = $host;
        $this->dbUser = $user;
        $this->dbPassword = $password;
        $this->tablePrefix = $prefix;
    }

    /**
     * Database connection function
     * @return \PDO object that connects to the database
     */
    function pdo() {
        // This ensures we only create the PDO object once
        if(self::$pdo !== null) {
            return self::$pdo;
        }

        try {
            self::$pdo = new \PDO($this->dbHost,
                $this->dbUser,
                $this->dbPassword);
        } catch(\PDOException $e) {
            // If we can't connect we die!
            die("Unable to select database");
        }

        return self::$pdo;
    }


    private $email = '';        // Site owner email address
    private $dbHost = null;     // Database host name
    private $dbUser = null;     // Database user name
    private $dbPassword = null; // Database password
    private $tablePrefix = '';  // Database table prefix
    private $root = '';         // Site root
    private static $pdo = null; // The PDO object

}