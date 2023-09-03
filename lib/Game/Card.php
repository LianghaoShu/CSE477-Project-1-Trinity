<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-14
 * Time: 17:17
 */

namespace Game;


class Card
{
    const SUSPECT = 1;  
    const WEAPON = 2;
    const ROOM = 3;

    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function getName(){
        return $this->name;
    }
    
    public function  getType(){
        return $this->type;
    }
    
    private $name;
    private $type;

}