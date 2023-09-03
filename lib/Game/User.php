<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-03-31
 * Time: 09:19
 */

namespace Game;


class User
{
    const SESSION_NAME = 'user';

    /**
     * Constructor
     * @param $row row from the user table in the database
     */
    public function __construct($row) {
        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->name = $row['name'];
        $this->joined = strtotime($row['joined']);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return false|int
     */
    public function getJoined()
    {
        return $this->joined;
    }

    /**
     * @param false|int $joined
     */
    public function setJoined($joined)
    {
        $this->joined = $joined;
    }




    private $id;		// The internal ID for the user
    private $email;		// Email address
    private $name; 		// Name as last, first
    private $joined;	// When user was added


}