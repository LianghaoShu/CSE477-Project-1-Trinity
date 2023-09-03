<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-20
 * Time: 00:04
 */

namespace Game;


class ShowCardsController
{
    public function __construct($game, $post)
    {
        $this->game = $game;
        if (isset($post['Next'])){
        }
    }

    public function IsEnd(){
        return $this->game->getStart();
    }

    private $game;
}