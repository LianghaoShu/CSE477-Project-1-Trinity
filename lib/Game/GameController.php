<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 2/20/2019
 * Time: 18:52
 */

namespace Game;


class GameController
{
    const CENTERINTERNATIONAL = array(4,3);
    const CENTERBRESLIN = array(5,12);
    const CENTERUNION = array(12,4);
    const CENTERWHARTON = array(21,3);
    const CENTERSTADIUM = array(21,12);
    const CENTERENGINEERING = array(23,19);
    const CENTERLIBRARY = array(16,20);
    const CENTERMUSEUM = array(10,20);
    const CENTERBEAUMONT = array(3,20);


    public function __construct(Game $game, Site $site, $post){
        $this->game = $game;



        if ($this->game->won()){
            exit;
        }
        if(isset($post['cell'])){

            $this->moveRoom($post);
        }
        if ($game->getMode() == Game::INROOM and isset($post['choice'])){
            $this->check_choices($post);
        }
        elseif ($game->getMode() == Game::ACCUSE or $game->getMode() == Game::SUGGEST) {
            if (isset($post['suspect'])) {
                $game->setSuspect(strip_tags($post['suspect']));
            }
        }
        elseif ($game->getMode() == Game::GUESSWEAPON) {
            if (isset($post['weapon'])) {
                $game->setWeapon(strip_tags($post['weapon']));
            }
        }
        elseif ($game->getMode() == Game::LOST or $game->getMode() == Game::HINT){
            if (isset($post['go'])){
                $this->game->nextTurn();
            }
        }

        $games = new Games($site);
        $games->saveGame($this->game);


    }

    public function check_choices($post){
        if ($post['choice'] == 'pass'){
            $this->game->nextTurn();
        }
        elseif ($post['choice'] == 'suggest'){
            $this->game->suggest();
        }
        elseif($post['choice'] == 'accuse') {
            $this->game->accuse();

        }

    }

    public function moveRoom($post){
        $postcoordinates = explode(', ',strip_tags($post['cell']));
        $postarray = array(+$postcoordinates[0], +$postcoordinates[1]);

        if($this->game->in_array_r(game::BRESLIN, $postarray)){
            $this->game->movetoRoom(self::CENTERBRESLIN);
        }
        elseif($this->game->in_array_r(game::INTERNATIONAL, $postarray)){
            $this->game->movetoRoom(self::CENTERINTERNATIONAL);
        }
        elseif($this->game->in_array_r(game::UNION, $postarray)){
            $this->game->movetoRoom(self::CENTERUNION);
        }
        elseif($this->game->in_array_r(game::WHARTON, $postarray)){
            $this->game->movetoRoom(self::CENTERWHARTON);
        }
        elseif($this->game->in_array_r(game::STADIUM, $postarray)){
            $this->game->movetoRoom(self::CENTERSTADIUM);
        }
        elseif($this->game->in_array_r(game::ENGINEERING, $postarray)){
            $this->game->movetoRoom(self::CENTERENGINEERING);
        }
        elseif($this->game->in_array_r(game::LIBRARY, $postarray)){
            $this->game->movetoRoom(self::CENTERLIBRARY);
        }
        elseif($this->game->in_array_r(game::MUSEUM, $postarray)){
            $this->game->movetoRoom(self::CENTERMUSEUM);
        }
        elseif($this->game->in_array_r(game::BEAUMONT, $postarray)){
            $this->game->movetoRoom(self::CENTERBEAUMONT);
        }
        else{
            $this->game->setCurrentPlayerPosition($postarray);
            $this->game->nextTurn();
        }

    }


    private $game;


}