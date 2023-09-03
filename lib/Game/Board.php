<?php
/**
 * Created by PhpStorm.
 * User: Lianghao Shu
 * Date: 2/15/2019
 * Time: 9:58 AM
 */

namespace Game;

class Board
{
    const ROW = 25;
    const COL = 24;
    const INTERNATIONAL = array(4,3);
    const BRESLIN = array(5,12);
    const UNION = array(12,4);
    const WHARTON = array(21,3);
    const STADIUM = array(21,12);
    const ENGINEERING = array(23,19);  
    const LIBRARY = array(16,20);
    const MUSEUM = array(10,20);
    const BEAUMONT = array(3,20);

    const ROOMANDUNREACHABLE = array(    [0,0],[0,1],[0,2],[0,3],[0,4],[0,5],[0,6],[0,7],[0,8],[0,10],[0,11],[0,12],[0,13],[0,15],[0,16],[0,17],[0,18],
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
        [24,15],[24,17],

        [1,10],[1,11],[1,12], [1,13],
        [2,8], [2,9], [2,10], [2,11], [2,12], [2,13], [2,14], [2,15],//breslin
        [3,8], [3,9], [3,10], [3,11], [3,12], [3,13], [3,14], [3,15],
        [4,8], [4,9], [4,10], [4,11], [4,12], [4,13], [4,14], [4,15],
        [5,8], [5,9], [5,10], [5,11], [5,12], [5,13], [5,14], [5,15],
        [6,8], [6,9], [6,10], [6,11], [6,12], [6,13], [6,14], [6,15],
        [7,8], [7,9], [7,10], [7,11], [7,12], [7,13], [7,14], [7,15],

        [1,0], [1,1], [1,2], [1,3], [1,4], [1,5],//international
        [2,0], [2,1], [2,2], [2,3], [2,4], [2,5],
        [3,0], [3,1], [3,2], [3,3], [3,4], [3,5],
        [4,0], [4,1], [4,2], [4,3], [4,4], [4,5],
        [5,0], [5,1], [5,2], [5,3], [5,4], [5,5],
        [6,1], [6,2], [6,3], [6,4], [6,5],

        [9,0], [9,1], [9,2], [9,3], [9,4],
        [10,0], [10,1], [10,2], [10,3], [10,4], [10,5], [10,6], [10,7],//union
        [11,0], [11,1], [11,2], [11,3], [11,4], [11,5], [11,6], [11,7],
        [12,0], [12,1], [12,2], [12,3], [12,4], [12,5], [12,6], [12,7],
        [13,0], [13,1], [13,2], [13,3], [13,4], [13,5], [13,6], [13,7],
        [14,0], [14,1], [14,2], [14,3], [14,4], [14,5], [14,6], [14,7],
        [15,0], [15,1], [15,2], [15,3], [15,4], [15,5], [15,6], [15,7],

        [19,0], [19,1], [19,2], [19,3], [19,4], [19,5], [19,6],//wharton
        [20,0], [20,1], [20,2], [20,3], [20,4], [20,5], [20,6],
        [21,0], [21,1], [21,2], [21,3], [21,4], [21,5], [21,6],
        [22,0], [22,1], [22,2], [22,3], [22,4], [22,5], [22,6],
        [23,0], [23,1], [23,2], [23,3], [23,4], [23,5], [23,6],
        [24,0], [24,1], [24,2], [24,3], [24,4], [24,5],

        [18,9], [18,10], [18,11], [18,12], [18,13], [18,14], //stadium
        [19,9], [19,10], [19,11], [19,12], [19,13], [19,14],
        [20,9], [20,10], [20,11], [20,12], [20,13], [20,14],
        [21,9], [21,10], [21,11], [21,12], [21,13], [21,14],
        [22,9], [22,10], [22,11], [22,12], [22,13], [22,14],
        [23,9], [23,10], [23,11], [23,12], [23,13], [23,14],
        [24,9], [24,10], [24,11], [24,12], [24,13], [24,14],

        [21,17], [21,18], [21,19], [21,20], [21,21], [21,22], [21,23],//engineering
        [22,17], [22,18], [22,19], [22,20], [22,21], [22,22], [22,23],
        [23,17], [23,18], [23,19], [23,20], [23,21], [23,22], [23,23],
        [24,18], [24,19], [24,20], [24,21], [24,22], [24,23],

        [14,18], [14,19], [14,20], [14,21], [14,22],// library
        [15,17], [15,18], [15,19], [15,20], [15,21], [15,22], [15,23],
        [16,17], [16,18], [16,19], [16,20], [16,21], [16,22], [16,23],
        [17,17], [17,18], [17,19], [17,20], [17,21], [17,22], [17,23],
        [18,18], [18,19], [18,20], [18,21], [18,22],

        [8,18], [8,19], [8,20], [8,21], [8,22], [8,23],//museum
        [9,18], [9,19], [9,20], [9,21], [9,22], [9,23],
        [10,18], [10,19], [10,20], [10,21], [10,22], [10,23],
        [11,18], [11,19], [11,20], [11,21], [11,22], [11,23],
        [12,18], [12,19], [12,20], [12,21], [12,22], [12,23],

        [1,18], [1,19], [1,20], [1,21], [1,22], [1,23],//beaumont
        [2,18], [2,19], [2,20], [2,21], [2,22], [2,23],
        [3,18], [3,19], [3,20], [3,21], [3,22], [3,23],
        [4,18], [4,19], [4,20], [4,21], [4,22], [4,23],
        [5,18], [5,19], [5,20], [5,21], [5,22]
    );
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
    const RBRESLIN = array(
        [1,10],[1,11],[1,12], [1,13],
        [2,8], [2,9], [2,10], [2,11], [2,12], [2,13], [2,14], [2,15],
        [3,8], [3,9], [3,10], [3,11], [3,12], [3,13], [3,14], [3,15],
        [4,8], [4,9], [4,10], [4,11], [4,12], [4,13], [4,14], [4,15],
        [5,8], [5,9], [5,10], [5,11], [5,12], [5,13], [5,14], [5,15],
        [6,8], [6,9], [6,10], [6,11], [6,12], [6,13], [6,14], [6,15],
        [7,8], [7,9], [7,10], [7,11], [7,12], [7,13], [7,14], [7,15]);
    const RINTERNATIONAL = array(
        [1,0], [1,1], [1,2], [1,3], [1,4], [1,5],
        [2,0], [2,1], [2,2], [2,3], [2,4], [2,5],
        [3,0], [3,1], [3,2], [3,3], [3,4], [3,5],
        [4,0], [4,1], [4,2], [4,3], [4,4], [4,5],
        [5,0], [5,1], [5,2], [5,3], [5,4], [5,5],
        [6,1], [6,2], [6,3], [6,4], [6,5]);

    const RUNION = array(
        [9,0], [9,1], [9,2], [9,3], [9,4],
        [10,0], [10,1], [10,2], [10,3], [10,4], [10,5], [10,6], [10,7],
        [11,0], [11,1], [11,2], [11,3], [11,4], [11,5], [11,6], [11,7],
        [12,0], [12,1], [12,2], [12,3], [12,4], [12,5], [12,6], [12,7],
        [13,0], [13,1], [13,2], [13,3], [13,4], [13,5], [13,6], [13,7],
        [14,0], [14,1], [14,2], [14,3], [14,4], [14,5], [14,6], [14,7],
        [15,0], [15,1], [15,2], [15,3], [15,4], [15,5], [15,6], [15,7]);
    const RWHARTON = array(
        [19,0], [19,1], [19,2], [19,3], [19,4], [19,5], [19,6],
        [20,0], [20,1], [20,2], [20,3], [20,4], [20,5], [20,6],
        [21,0], [21,1], [21,2], [21,3], [21,4], [21,5], [21,6],
        [22,0], [22,1], [22,2], [22,3], [22,4], [22,5], [22,6],
        [23,0], [23,1], [23,2], [23,3], [23,4], [23,5], [23,6],
        [24,0], [24,1], [24,2], [24,3], [24,4], [24,5]);
    const RSTADIUM = array(
        [18,9], [18,10], [18,11], [18,12], [18,13], [18,14],
        [19,9], [19,10], [19,11], [19,12], [19,13], [19,14],
        [20,9], [20,10], [20,11], [20,12], [20,13], [20,14],
        [21,9], [21,10], [21,11], [21,12], [21,13], [21,14],
        [22,9], [22,10], [22,11], [22,12], [22,13], [22,14],
        [23,9], [23,10], [23,11], [23,12], [23,13], [23,14],
        [24,9], [24,10], [24,11], [24,12], [24,13], [24,14]);
    const RENGINEERING = array(
        [21,17], [21,18], [21,19], [21,20], [21,21], [21,22], [21,23],
        [22,17], [22,18], [22,19], [22,20], [22,21], [22,22], [22,23],
        [23,17], [23,18], [23,19], [23,20], [23,21], [23,22], [23,23],
        [24,18], [24,19], [24,20], [24,21], [24,22], [24,23]);
    const RLIBRARY = array(
        [14,18], [14,19], [14,20], [14,21], [14,22],
        [15,17], [15,18], [15,19], [15,20], [15,21], [15,22], [15,23],
        [16,17], [16,18], [16,19], [16,20], [16,21], [16,22], [16,23],
        [17,17], [17,18], [17,19], [17,20], [17,21], [17,22], [17,23],
        [18,18], [18,19], [18,20], [18,21], [18,22]);
    const RMUSEUM = array(
        [8,18], [8,19], [8,20], [8,21], [8,22], [8,23],
        [9,18], [9,19], [9,20], [9,21], [9,22], [9,23],
        [10,18], [10,19], [10,20], [10,21], [10,22], [10,23],
        [11,18], [11,19], [11,20], [11,21], [11,22], [11,23],
        [12,18], [12,19], [12,20], [12,21], [12,22], [12,23]);
    const RBEAUMONT = array(
        [1,18], [1,19], [1,20], [1,21], [1,22], [1,23],
        [2,18], [2,19], [2,20], [2,21], [2,22], [2,23],
        [3,18], [3,19], [3,20], [3,21], [3,22], [3,23],
        [4,18], [4,19], [4,20], [4,21], [4,22], [4,23],
        [5,18], [5,19], [5,20], [5,21], [5,22]);

    const INTERNATIONALEDGE = array([7,4]);
    const BRESLINEDGE = array([5,7],[5,16],[8,9],[8,14]);
    const BEAUMONTEDGE = array([6,18]);
    const UNIONEDGE = array([12,8],[16,6]);
    const MUSEUMEDGE = array([9,17],[13,22]);
    const LIBRARYEDGE = array([13,20],[16,16]);
    const STADIUMEDGE = array([17,11],[17,12]);
    const WHARTONEDGE = array([18,6]);
    const ENGINEERINGEDGE = array([20,17]);




    public function __construct()
    {

        $library = new Node('library', self::LIBRARY[0], self::LIBRARY[1]);
        $breslin = new Node('breslin', self::BRESLIN[0], self::BRESLIN[1]);
        $beaumont = new Node('beaumont', self::BEAUMONT[0], self::BEAUMONT[1]);
        $union = new Node('union', self::UNION[0], self::UNION[1]);
        $museum = new Node('museum', self::MUSEUM[0], self::MUSEUM[1]);
        $international = new Node('international', self::INTERNATIONAL[0], self::INTERNATIONAL[1]);
        $wharton = new Node('wharton', self::WHARTON[0], self::WHARTON[1]);
        $stadium = new Node('stadium', self::STADIUM[0], self::STADIUM[1]);
        $engineering = new Node('engineering', self::ENGINEERING[0], self::ENGINEERING[1]);
        for ($i = 0; $i < self::ROW; $i++) {
            $row = array();
            for ($j = 0; $j < self::COL; $j++) {
                $node = 0;
                if(in_array(array($i,$j), self::RLIBRARY)){
                    $node = $library;
                }
                elseif (in_array(array($i,$j), self::RBRESLIN)) {
                    $node = $breslin;
                }
                elseif(in_array(array($i,$j), self::RBEAUMONT)){
                    $node = $beaumont;
                }
                elseif(in_array(array($i,$j), self::RUNION)){
                    $node = $union;
                }
                elseif(in_array(array($i,$j), self::RMUSEUM)){
                    $node = $museum;
                }
                elseif(in_array(array($i,$j), self::RINTERNATIONAL)){
                   $node = $international;
                }
                elseif(in_array(array($i,$j), self::RWHARTON)){
                   $node = $wharton;
                }
                elseif(in_array(array($i,$j), self::RSTADIUM)){
                    $node = $stadium;
                }
                elseif(in_array(array($i, $j), self::RENGINEERING)){
                    $node = $engineering;
                }

                else{
                    $node = new Node(0 ,$i, $j);
                }

                $row[] = $node;
            }
            $this->grid[] = $row;
        }


        foreach(self::INTERNATIONALEDGE as $edge){
            $adjacent = $this->grid[$edge[0]][$edge[1]];
            $international->addTo($adjacent);
            $adjacent->addTo($international);
        }

        foreach(self::BRESLINEDGE as $edge){
            $adjacent = $this->grid[$edge[0]][$edge[1]];
            $breslin->addTo($adjacent);
            $adjacent->addTo($breslin);
        }

        foreach(self::BEAUMONTEDGE as $edge){
            $adjacent = $this->grid[$edge[0]][$edge[1]];
            $beaumont->addTo($adjacent);
            $adjacent->addTo($beaumont);
        }

        foreach(self::UNIONEDGE as $edge){
            $adjacent = $this->grid[$edge[0]][$edge[1]];
            $union->addTo($adjacent);
            $adjacent->addTo($union);
        }

        foreach(self::MUSEUMEDGE as $edge){
            $adjacent = $this->grid[$edge[0]][$edge[1]];
            $museum->addTo($adjacent);
            $adjacent->addTo($museum);
        }

        foreach(self::LIBRARYEDGE as $edge){
            $adjacent = $this->grid[$edge[0]][$edge[1]];
            $library->addTo($adjacent);
            $adjacent->addTo($library);
        }

        foreach(self::STADIUMEDGE as $edge){
            $adjacent = $this->grid[$edge[0]][$edge[1]];
            $stadium->addTo($adjacent);
            $adjacent->addTo($stadium);
        }

        foreach(self::WHARTONEDGE as $edge){
            $adjacent = $this->grid[$edge[0]][$edge[1]];
            $wharton->addTo($adjacent);
            $adjacent->addTo($wharton);
        }

        foreach(self::ENGINEERINGEDGE as $edge){
            $adjacent = $this->grid[$edge[0]][$edge[1]];
            $engineering->addTo($adjacent);
            $adjacent->addTo($engineering);
        }


        $beaumont->setPassage($wharton);
        $wharton->setPassage($beaumont);
        $international->setPassage($engineering);
        $engineering->setPassage($international);

        for($i=0; $i<self::ROW; $i++) {
            for ($j = 0; $j < self::COL; $j++) {
                $position = array($i, $j);
                if (in_array($position, self::ROOMANDUNREACHABLE)) {
                    continue;
                }

                $upper = array($i - 1, $j);
                $below = array($i + 1, $j);
                $left = array($i, $j - 1);
                $right = array($i, $j + 1);

                //the node to  do the addto
                $node = $this->grid[$i][$j];

                if ($upper[0] >= 0 and $upper[0] < 25 and $upper[1] >= 0 and $upper[1] < 24) {
                    //  upper normal adjacent node
                    if (!in_array($upper, self::ROOMANDUNREACHABLE)) {
                        $adjacent = $this->grid[$upper[0]][$upper[1]];
                        // print_r($adjacent);
                        if (!in_array($adjacent, $node->getTo())) {
                            $node->addTo($adjacent);
                        }
                    }
                }

                if ($below[0] >= 0 and $below[0] < 25 and $below[1] >= 0 and $below[1] < 24) {
                    //  upper normal adjacent node
                    if (!in_array($below, self::ROOMANDUNREACHABLE)) {
                        $adjacent = $this->grid[$below[0]][$below[1]];
                        $node->addTo($adjacent);
                    }
                }

                if ($left[0] >= 0 and $left[0] < 25 and $left[1] >= 0 and $left[1] < 24) {
                    //  upper normal adjacent node
                    if (!in_array($left, self::ROOMANDUNREACHABLE)) {
                        $adjacent = $this->grid[$left[0]][$left[1]];
                        $node->addTo($adjacent);
                    }
                }

                if ($right[0] >= 0 and $right[0] < 25 and $right[1] >= 0 and $right[1] < 24) {
                    //  upper normal adjacent node
                    if (!in_array($right, self::ROOMANDUNREACHABLE)) {
                        $adjacent = $this->grid[$right[0]][$right[1]];
                        $node->addTo($adjacent);
                    }
                }
            }
        }
    }


    public function getGrid() {
        return $this->grid;
    }

    public function setGrid($grid){
        $this->grid = $grid;
    }

    public function disableBlock(){
        foreach($this->grid as $row){
            foreach($row as $node){
                $node->setBlock();
            }
        }
    }

    private $grid = []; // The graph of each cell on the board
}