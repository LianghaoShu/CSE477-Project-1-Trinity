<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2/15/2019
 * Time: 10:06 AM
 */

namespace Game;


class Player
{
    public function __construct($name, $cards, $other, $secret, $bot = False)
    {
        $this->name = $name;
        $this->cards = $cards;
        $this->othercards = $other;
        $this->hiddenwords = $secret;
        $this->bot = $bot;
        $this->location = array(0,0);
        if($name == "Owen"){
            $this->position = array(0,14);// 0 14
        }
        if($name == "McCullen"){
            $this->position = array(0,9);// 0 9
        }
        if($name == "Onsay"){
            $this->position = array(17,0);// 17 0
        }
        if($name == "Enbody"){
            $this->position = array(24,7);// 24 7
        }
        if($name == "Plum"){
            $this->position = array(19,23);// 19 23
        }
        if($name == "Day"){
            $this->position = array(7,23);//7 23
        }

    }

    public function getName(){
        return $this->name;
    }

    public function getLowerCaseName(){
        return strtolower($this->name);
    }

    public function getLocation(){
        return $this->location;
    }

    public function getPosition(){
        return $this->position;
    }

    public function isGuilty(){
        return $this->guilty;
    }

    public function getCards(){
        return $this->cards;
    }

    public function getOther(){
        return $this->othercards;
    }

    public function getSecret(){
        return $this->hiddenwords;
    }


    public function setCards($cards){
        $this->cards = $cards;
    }

    public function setOther($othercards){
        $this->othercards = $othercards;
    }

    public function setSecret($secretwords){
        $this->hiddenwords = $secretwords;
    }

    public function setLocation($location){
        $this->location = $location;
    }

    public function setPosition($position){
        $this->position = $position;
    }
    public function haslost(){
        $this->lost = True;
    }
    public function isLost(){
        return $this->lost;
    }

    //Needs Implementation
    public function contain($card){
        return in_array($card, $this->cards);
    }
    //Needs Implementation
    public function secret($word){
        $wordindex = array_search($word, $this->othercards);
        return $this->hiddenwords[$wordindex];
    }

    public function isBot(){
        return $this->bot;
    }

    public function setBot(){
        $this->bot == True;
    }

    public function getUserId() {
        return $this->userid;
    }

    public function setUserId($userId) {
        $this->userid = $userId;
    }

    private $name;
    private $userid;
    private $location;//room position or not in room
    private $position = [];//array position
    private $guilty = False;
    private $cards = [];
    private $lost = False;
    private $bot = False;

    private $othercards = [];
    private $hiddenwords = [];
}