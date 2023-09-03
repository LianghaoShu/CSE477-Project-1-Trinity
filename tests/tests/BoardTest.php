<?php
/**
 * Created by PhpStorm.
 * User: Lianghao Shu
 * Date: 2/15/2019
 * Time: 10:03 AM
 */

class BoardTest extends \PHPUnit\Framework\TestCase
{
    const ROW = 25;
    const COL = 24;
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

    const PINTERNATIONAL = array(4,3);
    const PBRESLIN = array(5,12);
    const PUNION = array(12,4);
    const PWHARTON = array(21,3);
    const PSTADIUM = array(21,12);
    const PENGINEERING = array(23,19);
    const PLIBRARY = array(16,20);
    const PMUSEUM = array(10,20);
    const PBEAUMONT = array(3,20);
    const INTERNATIONALEDGE = array([7,4]);
    const BRESLINEDGE = array([5,7],[5,16],[8,9],[8,14]);
    const BEAUMONTEDGE = array([6,18]);
    const UNIONEDGE = array([12,8]);
    const MUSEUMEDGE = array([9,17],[13,22]);
    const LIBRARYEDGE = array([13,20],[16,16]);
    const STADIUMEDGE = array([17,11],[17,12]);
    const WHARTONEDGE = array([18,6]);
    const ENGINEERINGEDGE = array([20,17]);


    public function test__construct()
    {

        $board = new \Game\Board();
        $this->assertInstanceOf('Game\Board', $board);

        $rowNum = count($board->getGrid());
        $this->assertEquals(self::ROW, $rowNum);


        $colNum = count($board->getGrid()[0]);
        $this->assertEquals(self::COL, $colNum);

        $node1 = $board->getGrid()[1][0];
        $node2 = $board->getGrid()[2][0];

        $this->assertEquals($node1, $node2);
        $this->assertEquals($node1, $node2);

        $normalnode = $board->getGrid()[23][19];

        $this->assertEquals(1, count($normalnode->getTo()));




      //  $this->assertTrue(in_array($node1, $node->getTo()));
        $node = $board->getGrid()[1][0];
        $this->assertInstanceOf('Game\Node', $node);
        $this->assertEquals('international', $node->getLocation());
        $node = $board->getGrid()[1][5];
        $this->assertEquals('international', $node->getLocation());

        $node = $board->getGrid()[0][0];
        $this->assertEquals(0, $node->getLocation());
        $this->assertEquals(array(0,0), $node->getPosition());

        $node1 = $board->getGrid()[1][0];
        $node2 = $board->getGrid()[1][1];
        $this->assertEquals($node1, $node2);

        foreach (self::INTERNATIONAL as $position) {
            $node = $board->getGrid()[$position[0]][$position[1]];
            $this->assertEquals('international', $node->getLocation());
            $this->assertEquals(self::PINTERNATIONAL,$node->getPosition());
        }

        foreach (self::BRESLIN as $position) {
            $node = $board->getGrid()[$position[0]][$position[1]];
            $this->assertEquals('breslin', $node->getLocation());
            $this->assertEquals(self::PBRESLIN,$node->getPosition());
        }

        foreach (self::UNION as $position) {
           $node = $board->getGrid()[$position[0]][$position[1]];
            $this->assertEquals('union', $node->getLocation());
            $this->assertEquals(self::PUNION,$node->getPosition());
        }

        foreach (self::WHARTON as $position) {
            $node = $board->getGrid()[$position[0]][$position[1]];
            $this->assertEquals('wharton', $node->getLocation());
            $this->assertEquals(self::PWHARTON,$node->getPosition());
        }

        foreach (self::STADIUM as $position) {
            $node = $board->getGrid()[$position[0]][$position[1]];
            $this->assertEquals('stadium', $node->getLocation());
            $this->assertEquals(self::PSTADIUM,$node->getPosition());
        }

        foreach (self::LIBRARY as $position) {
            $node = $board->getGrid()[$position[0]][$position[1]];
            $this->assertEquals('library', $node->getLocation());
            $this->assertEquals(self::PLIBRARY,$node->getPosition());
        }

        foreach (self::MUSEUM as $position) {
            $node = $board->getGrid()[$position[0]][$position[1]];
            $this->assertEquals('museum', $node->getLocation());
            $this->assertEquals(self::PMUSEUM,$node->getPosition());
        }

        foreach (self::BEAUMONT as $position) {
            $node = $board->getGrid()[$position[0]][$position[1]];
            $this->assertEquals('beaumont', $node->getLocation());
            $this->assertEquals(self::PBEAUMONT,$node->getPosition());
        }

        foreach (self::ENGINEERING as $position) {
            $node = $board->getGrid()[$position[0]][$position[1]];
            $this->assertEquals('engineering', $node->getLocation());
            $this->assertEquals(self::PENGINEERING,$node->getPosition());
        }

        $grid = $board->getGrid();
        for($i=0; $i<self::ROW; $i++){
            for($j = 0; $j < self::COL; $j++){
                if(in_array(array($i,$j), self::BEAUMONT) || in_array(array($i,$j),self::BRESLIN)||
                in_array(array($i,$j),self::ENGINEERING)|| in_array(array($i,$j), self::INTERNATIONAL)
                    || in_array(array($i,$j),self::LIBRARY) || in_array(array($i,$j), self::MUSEUM)||
                in_array(array($i,$j), self::STADIUM) || in_array(array($i,$j), self::UNION) ||
                in_array(array($i,$j), self::WHARTON) || in_array(array($i,$j),self::UNREACHABLE)){
                    continue;

                }

                $node = $grid[$i][$j];
                $this->assertEquals(array($i,$j), $node->getPosition());


            }
        }

        $international = $grid[3][1];
        $engineering = $grid[24][22];
        $wharton = $grid[24][2];
        $beaumont = $grid[3][19];

        $this->assertEquals($international, $engineering->getPassage());
        $this->assertEquals($engineering, $international->getPassage());
        $this->assertEquals($wharton, $beaumont->getPassage());
        $this->assertEquals($beaumont, $wharton->getPassage());

    }

    public function test_getGrid(){
        $board = new \Game\Board();
        $grid = "empty grid";
        $board->setGrid($grid);
        $this->assertEquals($grid, $board->getGrid());

    }

    public function test_disableBlock(){
        $board = new \Game\Board();
        $board->disableBlock();
        $grid = $board->getGrid();
        foreach($grid as $row){
            foreach($row as $node){
                $this->assertFalse($node->getReachable());
                $this->assertFalse($node->getBlock());
                $this->assertFalse($node->getPath());
            }
        }
    }



}