<?php
/**
 * Created by PhpStorm.
 * User: Lianghao Shu
 * Date: 2/15/2019
 * Time: 10:08 AM
 */

namespace Game;


class Node
{
    const UNREACHABLE = array(
        [0,0],[0,1],[0,2],[0,3],[0,4],[0,5],[0,6],[0,7],[0,8],[0,10],[0,11],[0,12],[0,13],[0,15],[0,16],[0,17],[0,18],
        [0,19],[0.20],[0,21],[0,22],[0,23],
        [1,6],[1,17],
        [5,23],
        [6,0],[6,23],
        [8,0],
        [10,10],[10,11],[10,12],[10,13],[10,14],
        [11,10],[11,11],[11,12],[11,13],[11,14],
        [12,10],[12,11],[12,12],[12,13],[12,14],
        [13,10],[13,11],[13,12],[13,13],[13,14],[13,23],
        [14,10],[14,11],[14,12],[14,13],[14,14],[14,23],
        [15,10],[15,11],[15,12],[15,13],[15,14],
        [16,10],[16,11],[16,12],[16,13],[16,14],[16,0],
        [18,0],[18,23],
        [20,23],
        [24,6],[24,8],
        [24,15],[24,17]
    );
    public function __construct($location = 0,$row = 1000,$col = 1000)
    {
        $this->location = $location;
        $this->row = $row;
        $this->col = $col;
    }


    public function addTo($to){
        $this->to[] = $to;
    }

    public function setReachable(){
        $this->reachable = true;
    }

    public function getReachable() {
        return $this->reachable;
    }


    public function Block(){
        if($this->location === 0) {
            $this->blocked = true;
        }
    }

    public function searchReachable($distance, $currentrow, $currentcol) {
        // The path is done if it at the end of the distance
        if($distance === 0) {
            $this->reachable = true;
            return;
        }

//not in the room
        if($this->location !== 0 and array($this->row, $this->col) != array($currentrow, $currentcol)){
            $this->reachable = true;
            return;
        }

        $this->onPath = true;

        if($this->location !== 0 and array($this->row, $this->col) === array($currentrow, $currentcol)){
            $this->reachable = true;
            if($this->passage !==0){
                $this->passage->setReachable();
            }
        }
        foreach($this->to as $to) {
            if(!$to->blocked && !$to->onPath) {
                $to->searchReachable($distance-1, $currentrow, $currentcol);
            }
        }

        $this->onPath = false;
    }

    public function getLocation(){
        return $this->location;
    }

    public function getPosition(){
        return array($this->row, $this->col);
    }

    public function getTo(){
        return $this->to;
    }

    public function setBlock(){
        $this->reachable = false;
        $this->onPath = false;
        $this->blocked = false;
    }

    public function getPath(){
        return $this->onPath;
    }

    public function getBlock(){
        return $this->blocked;
    }


    public function setPassage($node){
        $this->passage = $node;
    }

    public function getPassage(){
        return $this->passage;
    }

    private $to = []; //pointer to adjacent nodes
    // This node is on a current path
    private $onPath = false;
    // This node is blocked and cannot be visited
    private $blocked = false;
    // Node is reachable in the current move
    private $reachable = false;
    private $location = 0;
    private $row;
    private $col;
    private $passage = 0;




}