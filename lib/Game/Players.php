<?php
/**
 * Created by PhpStorm.
 * User: cgreene
 * Date: 2019-04-05
 * Time: 21:47
 */

namespace Game;


class Players extends Table {
    public function __construct(Site $site) {
        parent::__construct($site, 'player');
    }

    /**
     * Create a new player in the table
     * @param User $user The user that's being added to the game
     * @param Game $game The game object that this user is a part of
     */
    public function createGame_byId($userId, $gameId) {
        $sql = <<<SQL
insert into $this->tableName(userid, gameid) values(?,?)
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($userId, $gameId));
    }

    /**
     * Create a new player in the table
     * @param User $user The user that's being added to the game
     * @param Game $game The game object that this user is a part of
     */
    public function createGame(User $user, Game $game) {
        $sql = <<<SQL
insert into $this->tableName(userid, gameid) values(?)
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($user->getId(), $game->getId()));
    }



    /**
     * Clear out users that participated in a game
     * @param Game $game The game to end
     */
    public function clearGame(Game $game) {
        $sql = <<<SQL
delete from $this->tableName where gameid=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($game->getId()));
    }
    /**
     * Take the current game Id and return all userid associated with the $gameId
     * @param $gameId the game we are currently in
     * @return all the player ids in the game
     */
    public function getAllPlayersInGame($gameId){
        $sql = <<<SQL
SELECT userid
FROM $this->tableName
WHERE gameid = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        try {
            $statement->execute(array($gameId));
        } catch(\PDOException $e) {
            // do something when the exception occurs...
            return array();
        }
        if( $statement->rowCount() == 0 ){
            return array();
        }
        $ids = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $ids;

    }

    /**
     * Take the current game Id and return all userid associated with the $gameId
     * @param $userId the cureent use
     * @return all the player ids in the game
     */
    public function getUserGame($userId){
        $sql = <<<SQL
SELECT gameid
FROM $this->tableName
WHERE userid = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        try {
            $ret = $statement->execute(array($userId));
        } catch(\PDOException $e) {
            // do something when the exception occurs...
            return array();
        }
        if( $statement->rowCount() == 0 ){
            return array();
        }
        $id = $statement->fetch(\PDO::FETCH_ASSOC);
        return $id;

    }



    public function deletePlayerFromGame($userId){
        $sql=<<<SQL
DELETE FROM $this->tableName WHERE userid = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($userId));

    }


    public function deleteGame($gameId){
        $sql=<<<SQL
DELETE FROM $this->tableName WHERE gameid = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($gameId));

    }
}