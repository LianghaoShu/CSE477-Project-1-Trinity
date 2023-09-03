<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-04-08
 * Time: 17:23
 */

namespace Game;


class Lobbies extends Table
{
    public function __construct(Site $site) {
        parent::__construct($site, 'lobby');
    }

    /**
     * Create a new lobby in the table
     * @param Game $game The game object to add
     * @return int The id of the game that was inserted
     */
    public function createLobby($gameId) {
        $name = "lobby".$gameId;
        $sql = <<<SQL
insert into $this->tableName(name, gameId, numplayer) values(?,?,?)
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($name, $gameId, 1));
        return $this->pdo()->lastInsertId();
    }

    /**
     * Get a new game in the table
     * @param $id int the id of the game
     * @return array The game object.
     */
    public function getLobby($id) {

        $sql = <<<SQL
SELECT * FROM $this->tableName WHERE lobbyid = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));

        if ($statement->rowCount() === 0) {
            return null;
        }
        return $statement->fetch(\PDO::FETCH_ASSOC);

    }

    /**
     * Get a new game in the table
     * @param $id the id of the game
     * @return The game object.
     */
    public function getLobbyFromUserId($id) {
        $players = new Players($this->site);
        $playerTable = $players->getTableName();

        $sql = <<<SQL
SELECT l.lobbyid FROM $this->tableName as l
INNER JOIN $playerTable as p
ON p.userid = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));

        if ($statement->rowCount() === 0) {
            return null;
        }
        return $statement->fetch(\PDO::FETCH_ASSOC);

    }


    /**
     * Get a new game in the table
     * @param $id the id of the game
     * @return The game object.
     */
    public function getLobbies() {

        $sql = <<<SQL
SELECT * FROM $this->tableName
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }


    /**
     * Join a user to a lobby
     * @param $lobbyid int The lobby to join
     * @param $userid int The user ID to add to the lobby
     */
    public function joinLobby($lobbyid, $userid) {
        // Increment the number of players in the lobby
        $lobby = $this->getLobby($lobbyid);
        $p_count = $lobby['numplayer'];
        $p_count += 1;

        $sql = <<<SQL
update $this->tableName set numplayer=? where lobbyid=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($p_count, $lobbyid));

        // Add a new entry to players
        $players = new Players($this->site);
        $sql = <<<SQL
insert into $players->tableName values(gameid, userid) (?, ?)
SQL;
        $statement = $pdo->prepare($sql);

        $statement->execute(array($lobby['gameId'], $userid));
    }


    /**
     * Join a user to a lobby
     * @param $lobbyid int The lobby to join
     * @param $userid int The user ID to add to the lobby
     */
    public function leaveLobby($lobbyid, $userid, $gameid) {

        $games = new Games($this->site);



        // Increment the number of players in the lobby
        $lobby = $this->getLobby($lobbyid);
        $p_count = $lobby['numplayer'];
        $p_count -= 1;
        if ($p_count <= 0){
            $this->deleteLobby($lobbyid);
            $games->deleteGame($gameid);
            return;
        }

        $sql = <<<SQL
update $this->tableName set numplayer=? where lobbyid=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($p_count, $lobbyid));

        // Add a new entry to players
        $players = new Players($this->site);
        $sql = <<<SQL
insert into $players->tableName values(gameid, userid) (?, ?)
SQL;
        $statement = $pdo->prepare($sql);

        $statement->execute(array($lobby['gameId'], $userid));
    }




    /**
     * Restore a game from the database
     * @param $id int The id of the game to restore
     * @return Game The game from the database
     */
    public function restoreGame($id) {
        $sql = <<<SQL
select game from $this->tableName where lobbyid=?
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

        $sql = <<<SQL
delete from $this->tableName where lobbyid=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($game->getId()));
    }

    public function deleteLobby($lobbyId){
        $sql=<<<SQL
DELETE FROM $this->tableName WHERE lobbyid = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($lobbyId));
    }


    public function inLobby($userid){
        $players = new Players($this->site);
        $playerTable = $players->getTableName();
        $sql = <<<SQL
SELECT l.lobbyid 
FROM $this->tableName as l
INNER JOIN $playerTable as p
ON l.gameId = p.gameid
WHERE p.userid = ?
LIMIT 1
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($userid));
        $lobby = $statement->fetch(\PDO::FETCH_ASSOC);
        if($statement->rowCount() === 0) {
            return Null;
        }
        else {
            return $lobby['lobbyid'];
        }

    }

    /**
     * Returns an array of User objects that belong in a certain lobby
     * @param $id int the ID of the user
     * @return array of Users
     */
    public function getPlayers($id) {

      /*  print_r($id);
        $sql = <<<SQL
SELECT gameId
FROM $this->tableName
WHERE lobbyid = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($id));
        $gameId = $statement->fetch(\PDO::FETCH_ASSOC);
        $gameId = $gameId['gameid'];
        print_r("test");
        print_r($gameId);*/


        $players = new Players($this->site);
        $playerTable = $players->getTableName();
        $gameId =$players->getUserGame($id);

        $sql = <<<SQL
SELECT p.userid
FROM $playerTable as p
WHERE p.gameid = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($gameId['gameid']));
        $user_ids = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $lobbyPlayers = [];
        $users = new Users($this->site);
        foreach ($user_ids as $row) {
            $lobbyPlayers[] = $users->get($row['userid']);
        }

        return $lobbyPlayers;
    }
}