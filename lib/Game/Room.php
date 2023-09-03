<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-13
 * Time: 13:20
 */

namespace Game;


class Room
{
    public function __construct($name, $secret)
    {
        $this->name = $name;
        $this->secret_word = $secret;

    }

    public function getName(){
        return $this->name;
    }

    public function isOccupied(){
        return $this->occupied;
    }

    public function occupy($player){
        $this->occupied = true;
        $this->players[] = $player;
    }

    public function getSuspect(){
        return $this->suspect;
    }

    public function getPlayers(){
        return $this->players;
    }

    public function getPassage(){
        return $this->passage;
    }

    public function getSecret(){
        return $this->secret_word;
    }
    
    public function connect($room){
        $this->passage = $room;
        
    }
    
    private $name;
    private $occupied = false;
    private $suspect = null;
    private $players = null;
    private $passage = null;
    private $secret_word = null;


}