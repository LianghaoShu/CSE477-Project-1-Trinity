<?php
/**
 * Created by PhpStorm.
 * User: cgreene
 * Date: 2019-04-05
 * Time: 21:33
 */

namespace Game;


class Games extends Table {
    public function __construct(Site $site) {
        parent::__construct($site, 'game');
        $this->site = $site;
    }

    /**
     * Create a new game in the table
     * @param Game $game The game object to add
     * @return int The id of the game that was inserted
     */
    public function createGame(Game $game) {
        $serialized = serialize($game);

        $sql = <<<SQL
insert into $this->tableName(game) values(?)
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($serialized));
        return $this->pdo()->lastInsertId();
    }



    /**
     * Save a new game state to the database
     * @param Game $game The game to save
     */
    public function saveGame(Game $game) {
        $serialized = serialize($game);

        $sql = <<<SQL
update $this->tableName set game=? where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($serialized, $game->getId()));
    }

    /**
     * Restore a game from the database
     * @param $id int The id of the game to restore
     * @return Game The game from the database
     */
    public function restoreGame($id) {
        $sql = <<<SQL
select game from $this->tableName where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        return unserialize($row['game']);
    }

    /**
     * Restore a game from the database
     * @param $id int The id of the game to restore
     * @return Game The game from the database
     */
    public function restoreUserGame($id) {
        $players = new Players($this->site);
        $playerTable = $players->getTableName();
        $sql = <<<SQL
select g.game from $this->tableName  as g
INNER JOIN $playerTable as p
ON p.gameid = g.id
where p.userid= ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        return unserialize($row['game']);
    }

    /**
     * End a game (delete it from the table)
     * @param Game $game The game to delete
     */
    public function endGame(Game $game) {
        $players = new Players($this->site);
        $players->clearGame($game);
        $id = $game->getId();
        $prefix = $this->site->getTablePrefix();
        $gameplayertable = $prefix . "GamePlayer";
        $gametable = $prefix . "game";
        $playertable = $prefix . "player";


        $sql = <<<SQL
delete from $this->tableName where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($game->getId()));

        $sql = <<<SQL
delete from $this->tableName where gameid=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($game->getId()));

    }

    /**
     * End a game (delete it from the table)
     * @param Game $gameId the id of the game
     */
    public function deleteGame($gameId) {

        $sql = <<<SQL
delete from $this->tableName where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($gameId));
    }

    /**
     * End a game (delete it from the table)
     * @param $userId the id of the user
     */
    public function inGame($userId) {
        $sql = <<<SQL
SELECT * from $this->tableName where userId = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($userId));

        $statement->fetch(\PDO::FETCH_ASSOC);
        if($statement->rowCount() === 0) {
            return Null;
        }
        else {
            return $lobby['lobbyid'];
        }

    }
}

