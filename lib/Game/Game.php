<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 2/17/2019
 * Time: 19:31
 */

namespace Game;




class Game
{

    const SUGGEST = 1;
    const ACCUSE  = 2;
    const GUESSWEAPON = 3;
    const WHODID = 4;
    const WITH = 5;
    const DICE = 6;
    const INROOM = 7;
    const HINT = 8;
    const WON = 9;
    const LOST = 10;
    const BRESLIN = array(
        [1,10],[1,11],[1,12], [1,13],
        [2,8], [2,9], [2,10], [2,11], [2,12], [2,13], [2,14], [2,15],
        [3,8], [3,9], [3,10], [3,11], [3,12], [3,13], [3,14], [3,15],
        [4,8], [4,9], [4,10], [4,11], [4,12], [4,13], [4,14], [4,15],
        [5,8], [5,9], [5,10], [5,11], [5,12], [5,13], [5,14], [5,15],
        [6,8], [6,9], [6,10], [6,11], [6,12], [6,13], [6,14], [6,15],
        [7,8], [7,9], [7,10], [7,11], [7,12], [7,13], [7,14], [7,15]);
    const INTERNATIONAL = array(
        [1,0], [1,1], [1,2], [1,3], [1,4], [1,5],
        [2,0], [2,1], [2,2], [2,3], [2,4], [2,5],
        [3,0], [3,1], [3,2], [3,3], [3,4], [3,5],
        [4,0], [4,1], [4,2], [4,3], [4,4], [4,5],
        [5,0], [5,1], [5,2], [5,3], [5,4], [5,5],
        [6,1], [6,2], [6,3], [6,4], [6,5]);
    const UNION = array(
        [9,0], [9,1], [9,2], [9,3], [9,4],
        [10,0], [10,1], [10,2], [10,3], [10,4], [10,5], [10,6], [10,7],
        [11,0], [11,1], [11,2], [11,3], [11,4], [11,5], [11,6], [11,7],
        [12,0], [12,1], [12,2], [12,3], [12,4], [12,5], [12,6], [12,7],
        [13,0], [13,1], [13,2], [13,3], [13,4], [13,5], [13,6], [13,7],
        [14,0], [14,1], [14,2], [14,3], [14,4], [14,5], [14,6], [14,7],
        [15,0], [15,1], [15,2], [15,3], [15,4], [15,5], [15,6], [15,7]);
    const WHARTON = array(
        [19,0], [19,1], [19,2], [19,3], [19,4], [19,5], [19,6],
        [20,0], [20,1], [20,2], [20,3], [20,4], [20,5], [20,6],
        [21,0], [21,1], [21,2], [21,3], [21,4], [21,5], [21,6],
        [22,0], [22,1], [22,2], [22,3], [22,4], [22,5], [22,6],
        [23,0], [23,1], [23,2], [23,3], [23,4], [23,5], [23,6],
        [24,0], [24,1], [24,2], [24,3], [24,4], [24,5]);
    const STADIUM = array(
        [18,9], [18,10], [18,11], [18,12], [18,13], [18,14],
        [19,9], [19,10], [19,11], [19,12], [19,13], [19,14],
        [20,9], [20,10], [20,11], [20,12], [20,13], [20,14],
        [21,9], [21,10], [21,11], [21,12], [21,13], [21,14],
        [22,9], [22,10], [22,11], [22,12], [22,13], [22,14],
        [23,9], [23,10], [23,11], [23,12], [23,13], [23,14],
        [24,9], [24,10], [24,11], [24,12], [24,13], [24,14]);
    const ENGINEERING = array(
        [21,17], [21,18], [21,19], [21,20], [21,21], [21,22], [21,23],
        [22,17], [22,18], [22,19], [22,20], [22,21], [22,22], [22,23],
        [23,17], [23,18], [23,19], [23,20], [23,21], [23,22], [23,23],
        [24,18], [24,19], [24,20], [24,21], [24,22], [24,23]);
    const LIBRARY = array(
        [14,18], [14,19], [14,20], [14,21], [14,22],
        [15,17], [15,18], [15,19], [15,20], [15,21], [15,22], [15,23],
        [16,17], [16,18], [16,19], [16,20], [16,21], [16,22], [16,23],
        [17,17], [17,18], [17,19], [17,20], [17,21], [17,22], [17,23],
        [18,18], [18,19], [18,20], [18,21], [18,22]);
    const MUSEUM = array(
        [8,18], [8,19], [8,20], [8,21], [8,22], [8,23],
        [9,18], [9,19], [9,20], [9,21], [9,22], [9,23],
        [10,18], [10,19], [10,20], [10,21], [10,22], [10,23],
        [11,18], [11,19], [11,20], [11,21], [11,22], [11,23],
        [12,18], [12,19], [12,20], [12,21], [12,22], [12,23]);
    const BEAUMONT = array(
        [1,18], [1,19], [1,20], [1,21], [1,22], [1,23],
        [2,18], [2,19], [2,20], [2,21], [2,22], [2,23],
        [3,18], [3,19], [3,20], [3,21], [3,22], [3,23],
        [4,18], [4,19], [4,20], [4,21], [4,22], [4,23],
        [5,18], [5,19], [5,20], [5,21], [5,22]);

    const PLAYER_NAMES = array("Owen", "McCullen", "Onsay", "Enbody", "Plum", "Day");

    public function __construct(){
        $this->currentPlayerIdx = 0;
        $this->mode = self::DICE;
        //$this->mode = self::INROOM;
        $this->dice1 = mt_rand(1,6);
        $this->dice2 = mt_rand(1,6);
        $this->board = new Board();
    }

    //test
    public function showlocation(){
        return $this->board->getGrid()[1][0];
    }

    public function getMode(){
        return $this->mode;
    }
    public function setPlayers($players){
        $this->players = $players;
    }
    public function getPlayerCount(){
        return count($this->players);
    }
    public function getPlayerRoom(){
        return $this->players[$this->currentPlayerIdx]->getPosition();
    }
    public function setMurderer($person)
    {
        $this->murderer = $person;
    }
    public function setMurderWeapon($weapon)
    {
        $this->murderweapon = $weapon;
    }
    public function setMurderLocation($location)
    {
        $this->murderlocation = $location;
    }

    public function getMurderer(){
        return $this->murderer;
    }

    public function getMurderWeapon(){
        return $this->murderweapon;
    }

    public function getMurderLocation(){
        return $this->murderlocation;
    }

    // Set the current playing player,
    // param the idx the idx of the player to set to
    public function setCurrentPlayerIdx($idx){
        $this->currentPlayerIdx = $idx;

    }

    public function getCurrentPlayerIdx(){
        return $this->currentPlayerIdx;
    }

    public function getCurrentPlayer(){
        return $this->players[$this->currentPlayerIdx]->getName();
    }
    public function getPlayerStatus(){
        return $this->players[$this->currentPlayerIdx]->isLost();

    }
    public function getBoard() {
        return $this->board;
    }

    public function Disable(){
        $this->board->disableBlock();
    }
    private $players = [];
    private $murderer;
    private $murderlocation;
    private $murderweapon;
    private $board;


    /*
     * Below functions and members are used to get from welcome.php to game.php
     */
    public function getIdx(){
        return $this->idx;
    }
    public function setIdx($idx){
        $this->idx = $idx;
    }
    public function Start(){
        $this->start = true;
    }
    public function getStart(){
        return $this->start;
    }
    public function getPlayers()
    {
        return $this->players;
    }
    private $idx = 0;
    private $start = false;

/*Dice Roll*/

    private $dice1 = 0;
    private $dice2 = 0;

    public function getDice1(){
        return $this->dice1;
    }
    public function getDice2(){
        return $this->dice2;
    }
    public function Dice1Num(){
        $this->dice1 = mt_rand(1,6);
        return $this->dice1;
    }
    public function Dice2Num(){
        $this->dice2= mt_rand(1,6);
        return $this->dice2;
    }


    //Turn System and suggestions and accusations

    public function nextTurn(){
        $this->currentPlayerIdx = ($this->currentPlayerIdx + 1) % count($this->players);
        if($this->players[$this->currentPlayerIdx]->isBot()){
            $this->nextTurn();
        }
        $this->guessWeapon = -1;
        $this->guessName = -1;
        $this->mode = self::DICE;
        $this->Dice1Num();
        $this->Dice2Num();
    }

    public function suggest(){
        $this->mode = self::SUGGEST;
        $this->choice = self::SUGGEST;
        $this->currRoom = $this->players[$this->currentPlayerIdx]->getPosition();
    }

    public function accuse(){
        $this->mode = self::ACCUSE;
        $this->choice = self::ACCUSE;
        $this->currRoom = $this->players[$this->currentPlayerIdx]->getPosition();
    }

    public function setSuspect($suspect){
        $this->guessName = $suspect;
        $this->moveSuspect($suspect);

        $this->mode = self::GUESSWEAPON;
    }

    public function moveSuspect($suspect){
        for ($i = 0; $i<count($this->players); $i++){
            if (strtolower($this->players[$i]->getName()) == strtolower($suspect)){
                $this->players[$i]->setPosition($this->players[$this->currentPlayerIdx]->getPosition());
            }
        }
    }
    public function setWeapon($weapon){
        $this->guessWeapon = $weapon;
        if ($this->choice == self::SUGGEST){
            $this->mode = self::HINT;
        }
        else{
            if ($this->checkGuess()){
                $this->mode = self::WON;
                $this->won = True;
            }
            else{
                $this->players[$this->currentPlayerIdx]->hasLost();
                $this->mode = self::LOST;
            }
        }
    }
    public function hint(){
        $room = $this->cord_to_room($this->currRoom);
        foreach($this->players as $p){
            if ($p->getName() != $this->getCurrentPlayer()){
                if ($p->contain($this->guessName)){
                    return $this->players[$this->currentPlayerIdx]->secret($this->guessName);
                }
                elseif($p->contain($this->guessWeapon)) {
                    return $this->players[$this->currentPlayerIdx]->secret($this->guessWeapon);
                }
                elseif($p->contain($room)){
                    return $this->players[$this->currentPlayerIdx]->secret($room);
                }
            }
        }
        return "I got nothing";
    }

    public function setGuess($murderer, $weapon, $room){
        $this->guessName = $murderer;
        $this->guessWeapon = $weapon;
        $this->currRoom = $room;
    }

    public function checkGuess(){
        if ($this->guessName === $this->murderer){
            if ($this->guessWeapon === $this->murderweapon) {
                $room = $this->cord_to_room($this->currRoom);
                if ($this->murderlocation === $room){
                    return True;
                }
            }
        }
        return False;
    }

    //NEED TO FINISH
    public function cord_to_room($location){
        if ($location === Board::INTERNATIONAL) {
            return "international";
        }
        else if ($location === Board::BEAUMONT) {
            return "beaumont";
        }
        if ($location === Board::LIBRARY) {
            return "library";
        }
        if ($location === Board::MUSEUM) {
            return "museum";
        }
        if ($location === Board::ENGINEERING) {
            return "engineering";
        }
        if ($location === Board::UNION) {
            return "union";
        }
        if ($location === Board::BRESLIN) {
            return "breslin";
        }
        if ($location === Board::STADIUM) {
            return "stadium";
        }
        if ($location === Board::WHARTON) {
            return "wharton";
        }

    }


    public function ifinRoom(){
        if($this->in_array_r(self::INTERNATIONAL,$this->players[$this->currentPlayerIdx]->getPosition())){
            $this->mode = self::INROOM;
        }
        if($this->in_array_r(self::BRESLIN,$this->players[$this->currentPlayerIdx]->getPosition())){
            $this->mode = self::INROOM;
        }
        if($this->in_array_r(self::UNION,$this->players[$this->currentPlayerIdx]->getPosition())){
            $this->mode = self::INROOM;
        }
        if($this->in_array_r(self::WHARTON,$this->players[$this->currentPlayerIdx]->getPosition())){
            $this->mode = self::INROOM;
        }
        if($this->in_array_r(self::STADIUM,$this->players[$this->currentPlayerIdx]->getPosition())){
            $this->mode = self::INROOM;
        }
        if($this->in_array_r(self::ENGINEERING,$this->players[$this->currentPlayerIdx]->getPosition())){
            $this->mode = self::INROOM;
        }
        if($this->in_array_r(self::LIBRARY,$this->players[$this->currentPlayerIdx]->getPosition())){
            $this->mode = self::INROOM;
        }
        if($this->in_array_r(self::MUSEUM,$this->players[$this->currentPlayerIdx]->getPosition())){
            $this->mode = self::INROOM;
        }
        if($this->in_array_r(self::BEAUMONT,$this->players[$this->currentPlayerIdx]->getPosition())){
            $this->mode = self::INROOM;
        }
    }

    public function in_array_r($haystack, $needle, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($item, $needle, $strict))) {
                return true;
            }
        }
        return false;
    }

    public function movetoRoom($position){
        $this->players[$this->currentPlayerIdx]->setPosition($position);
        $this->ifinRoom();
    }

    public function setCurrentPlayerPosition($position){
        $this->players[$this->currentPlayerIdx]->setPosition($position);
    }

    public function won(){
        return $this->won;
    }

    public function setMode($mode){
        $this->mode = $mode;
    }

    public function get_GuessName(){
        return $this->guessName;
    }
    public function get_GuessWeapon(){
        return $this->guessWeapon;
    }
    public function get_GuesLocation(){
        return $this->currRoom;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    private $id;
    private $won = False;
    private $mode;
    private $choice;
    private $guessName = "temp";
    private $guessWeapon = "temp";
    private $currRoom;
    private $currentPlayerIdx;



}