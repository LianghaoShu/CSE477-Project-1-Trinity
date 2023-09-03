<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 2019-02-14
 * Time: 17:42
 */

class RoomTest extends \PHPUnit\Framework\TestCase
{
    public function test_construct(){
        $room = new Game\Room("Engineering", "blowtorch");
        $this->assertInstanceOf('Game\Room', $room);
    }
    public function test_connect(){
        $room1 = new Game\Room("Engineering", "blowtorch");
        $room2 = new Game\Room("Tower", "Jungle");
        $room1->connect($room2);
        $this->assertEquals($room2, $room1->getPassage());
    }
    //Need more tests after player is added

}