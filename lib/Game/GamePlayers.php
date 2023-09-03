<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-04-10
 * Time: 21:26
 */

namespace Game;


class GamePlayers extends table
{
    public function __construct(Site $site) {
        parent::__construct($site, 'GamePlayer');
    }

    public function update($gameId , $col, $val){
        $column = '';
        if ($col == "owen"){
            $column = 'owen';
        }
        elseif ($col == "mccullen"){
            $column = 'mccullen';
        }
        elseif ($col == "day"){
            $column = 'day';
        }
        elseif ($col == "enbody"){
            $column = 'enbody';
        }
        elseif ($col == "onsay"){
            $column = 'onsay';
        }
        elseif ($col == "plum"){
            $column = 'plus';
        }

        $sql = <<<SQL
update $this->tableName SET $column = ? WHERE gameid = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        print_r($col);


        $statement->execute(array($val, $gameId));
        print_r($statement);
    }

    /**
     * Create a new game in the table
     * @param Game $game The game object to add
     * @return int The id of the game that was inserted
     */
    public function createGame($gameId) {

        $sql = <<<SQL
insert into $this->tableName(gameid) values(?)
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($gameId));
        return $this->pdo()->lastInsertId();
    }

    public function inGame($userId){
        $players = new Players($this->site);
        $gameId = $players->getUserGame($userId);
        $sql = <<<SQL
SELECT * FROM $this->tableName WHERE gameid = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($gameId['gameid']));

        if($statement->rowCount() === 0) {
            return null;
        }
        return True;
    }

    public function deleteGame($gameId){
        $sql=<<<SQL
DELETE FROM $this->tableName WHERE gameid = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($gameId));
    }


    /**
     * Determine if it's a user's turn
     * @param $game Game The game the user is in
     * @param $userid int The user id to check
     * @return bool Whether or not it is the user's turn
     */
    public function myTurn($game, $userid) {
        $gameid = $game->getId();

        $sql =<<<SQL
select * from $this->tableName where gameid=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($gameid));
        $cols = $statement->fetch(\PDO::FETCH_ASSOC);

        $currentName = strtolower($game->getCurrentPlayer());
        foreach($cols as $name => $id) {
            if ($name === $currentName && $id == $userid) {
                return true;
            }
        }
        return false;
    }
}