<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-04-07
 * Time: 11:54
 */

namespace Game;


class Validators extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "validator");
    }

    /**
     * Create a new validator and add it to the table.
     * @param $userid User this validator is for.
     * @return The new validator.
     */
    public function newValidator($userid) {
        $validator = $this->createValidator();
        $sql = <<<SQL
insert into $this->tableName(userid, validator, date)
values(?, ?, now())
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute([$userid,
                        $validator]
                ) === false) {
                return $validator;
            }
        } catch(\PDOException $e) {
            return $validator;
        }

        // Write to the table



        return $validator;

    }

    /**
     * Generate a random validator string of characters
     * @param $len Length to generate, default is 32
     * @return Validators string
     */
    public function createValidator($len = 32) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }

    /**
     * Determine if a validator is valid. If it is,
     * return the user ID for that validator.
     * @param $validator Validators to look up
     * @return User ID or null if not found.
     */
    public function get($validator) {
        $sql =<<<SQL
SELECT userid from $this->tableName
where validator = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($validator));
        if($statement->rowCount() === 0) {
            return null;
        }

        return $statement->fetch(\PDO::FETCH_ASSOC)['userid'];


    }

    /**
     * Remove any validators for this user ID.
     * @param $userid The USER ID we are clearing validators for.
     */
    public function remove($userid) {
        $sql = <<<SQL
DELETE FROM $this->tableName WHERE userid = ?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute([$userid]
                ) === false) {
                return null;
            }
        } catch(\PDOException $e) {
            return null;
        }
        return True;

    }

}