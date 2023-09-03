<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-14
 * Time: 17:16
 */

namespace Game;


class Cards
{
    public function __construct($cards = array())
    {
        $this->cards = $cards;

    }

    public function getCards(){
        return $this->cards;
    }

    private $cards;

}