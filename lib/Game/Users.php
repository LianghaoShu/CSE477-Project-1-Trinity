<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 3/30/2019
 * Time: 19:33
 */

namespace Game;


class Users extends Table
{

    public function __construct(Site $site)
    {
        parent::__construct($site, "user");
    }

    public function login($email, $password) {
        $sql =<<<SQL
SELECT * from $this->tableName
where email=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return null;
        }

        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        // Get the encrypted password and salt from the record
        $hash = $row['password'];
        $salt = $row['salt'];

        // Ensure it is correct
        if($hash !== hash("sha256", $password . $salt)) {
            return null;
        }

        return new User($row);
    }


    public function get($id)
    {
        $sql = <<<SQL
SELECT * from $this->tableName
where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($id));
        if ($statement->rowCount() === 0) {
            return null;
        }
        return new User($statement->fetch(\PDO::FETCH_ASSOC));
    }

    /**
     * Modify a user record based on the contents of a User object
     * @param User $user User object for object with modified data
     * @return true if successful, false if failed or user does not exist
     */
    public function update(User $user)
    {
        $sql = <<<SQL
UPDATE $this->tableName
SET email=?, joined=?, name = ?
WHERE  id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        try {
            $statement->execute(array($user->getEmail(), $user->getJoined(), $user->getName(),$user->getId()));
        } catch (\PDOException $e) {
            return false;
        }
        if ($statement->rowCount() === 0) {
            return false;
        }
        return true;
    }

    /**
     * Determine if a user exists in the system.
     * @param $email An email address.
     * @return true if $email is an existing email address
     */
    public function exists($email)
    {
        $sql = <<<SQL
SELECT * FROM $this->tableName
WHERE email=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($email));
        if ($statement->rowCount() === 0) {
            return false;
        } else {
            return true;
        }
        $row = $statement->fetch(\PDO::FETCH_ASSOC);

    }


    /**
     * Create a new user.
     * @param User $user The new user data
     * @param Email $mailer An Email object to use
     * @return null on success or error message if failure
     */
    public function add(User $user, Email $mailer) {
        // Ensure we have no duplicate email address
        if($this->exists($user->getEmail())) {
            return "Email address already exists.";
        }

        // Add a record to the user table
        $sql = <<<SQL
INSERT INTO $this->tableName(email, name, joined)
values(?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute([
            $user->getEmail(), $user->getName(), date("Y-m-d H:i:s")]);
        $id = $this->pdo()->lastInsertId();



        //Create a validator and add to the validator table
        $validators = new Validators($this->site);
        $validator = $validators->newValidator($id);


        // Send email with the validator in it
        $link = "http://webdev.cse.msu.edu"  . $this->site->getRoot() .
            '/password-validate.php?v=' . $validator;

        $from = $this->site->getEmail();
        $name = $user->getName();

        $subject = "Confirm your email";
        $message = <<<MSG
<html>
<p>Greetings, $name,</p>

<p>Welcome to Who Murdered My Grades Trinity Version. In order to complete your registration,
please verify your email address by visiting the following link:</p>

<p><a href="$link">$link</a></p>
</html>
MSG;
        $headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso=8859-1\r\nFrom: $from\r\n";
        $mailer->mail($user->getEmail(), $subject, $message, $headers);

        // Send email with the validator in it
    }

    public function getUsers(){
        $sql = <<<SQL
SELECT *
FROM $this->tableName
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        try {
            $ret = $statement->execute();
        } catch(\PDOException $e) {
            // do something when the exception occurs...
            return array();
        }
        if( $statement->rowCount() == 0 ){
            return array();
        }
        $records = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $users = array(); // array of ClientCases to return
        for($i=0; $i<sizeof($records); $i++){
            $user = new User($records[$i]);
            $users[] = $user;
        }
        return $users;
    }


    /**
     * Set the password for a user
     * @param $userid The ID for the user
     * @param $password New password to set
     */
    public function setPassword($userid, $password) {
        $sql1=<<<SQL
SELECT $this->tableName.salt
FROM $this->tableName
WHERE id = ?
SQL;
        $statement = $this->pdo()->prepare($sql1);

        $statement->execute([
            $userid
        ]);

        $salt = ($statement->fetch(\PDO::FETCH_ASSOC))['salt'];
        $hash = hash("sha256", $password . $salt);

        $sql2 = <<<SQL
UPDATE $this->tableName
SET password = ?, salt=?
WHERE id = ?
SQL;
        $statement = $this->pdo()->prepare($sql2);
        $statement->execute([
            $hash ,$salt,$userid
        ]);

    }

    public function delete($id){
        $sql =<<<SQL
DELETE FROM $this->tableName
WHERE id = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try{
            $statement->execute(array($id));
        }catch(\PDOException $e){
            return false;
        }

        if ($statement->rowCount() === 0){
            return False;
        }
        return True;


    }



}