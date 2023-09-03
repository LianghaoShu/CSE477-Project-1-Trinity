<?php
/**
 * Created by PhpStorm.
 * User: Lianghao Shu
 * Date: 2/15/2019
 * Time: 10:11 AM
 */

class NodeTest extends \PHPUnit\Framework\TestCase
{
    public function test_construct(){
        $node = new \Game\Node();
        $this->assertInstanceOf('Game\Node', $node);
    }

    public function test_getLocationPosition(){
        $node = new \Game\Node();
        $this->assertEquals(0,$node->getLocation());

        $node = new \Game\Node("library");
        $this->assertEquals('library', $node->getLocation());
        $this->assertEquals(array(1000,1000), $node->getPosition());

        $node = new \Game\Node("library", 20,30);
        $this->assertEquals(array(20,30), $node->getPosition());

        $node = new \Game\Node("library", 0 , 0);
        $this->assertEquals(array(0,0) , $node->getPosition());
    }

    public function test_addToandgetTo(){
        $node = new \Game\Node();
        $node->addTo("giao");
        $this->assertTrue(in_array("giao", $node->getTo()));
    }

    public function test_setgetReachable(){
        $node = new \Game\Node();
        $this->assertFalse($node->getReachable());
        $node->setReachable();
        $this->assertTrue($node->getReachable());

    }

    public function test_Block(){
        $node = new \Game\Node();
        $this->assertFalse($node->getBlock());
        $node->Block();
        $this->assertTrue($node->getBlock());

        $node1 = new \Game\Node("international");
        $this->assertFalse($node1->getBlock());
        $node1->Block();
        $this->assertFalse($node1->getBlock());

    }

    public function test_getPath(){
        $node = new \Game\Node();
        $this->assertFalse($node->getPath());
    }

    public function test_setBlock(){
        $node = new \Game\Node();
        $node->Block();
        $node->setReachable();
        $this->assertTrue($node->getBlock());
        $this->assertTrue($node->getReachable());

    }

    public function test_setgetPassage(){
        $node1 = new \Game\Node();
        $node2 = new \Game\Node();
        $this->assertEquals(0, $node1->getPassage());
        $node1->setPassage($node2);
        $this->assertEquals($node2, $node1->getPassage());
    }

    public function test_searchReachable(){

        $node1 = new \Game\Node(0,0,0);
        $node2 = new \Game\Node(0,0,1);
        $node3 = new \Game\Node(0,0,2);
        $node4 = new \Game\Node(0,1,0);
        $node5 = new \Game\Node("international",1,1);
        $node6 = new \Game\Node(0,1,2);
        $node7 = new \Game\Node(0,2,0);
        $node8 = new \Game\Node(0,2,1);
        $node9 = new \Game\Node("breslin",2,2);

        $node1->addTo($node2);
        $node1->addTo($node4);
        $node2->addTo($node1);
        $node2->addTo($node3);
        $node3->addTo($node2);
        $node3->addTo($node6);
        $node4->addTo($node5);
        $node4->addTo($node1);
        $node4->addTo($node7);
        $node5->addTo($node4);
        $node5->setPassage($node9);
        $node6->addTo($node3);
        $node7->addTo($node4);
        $node7->addTo($node8);
        $node8->addTo($node7);
        $node8->addTo($node9);
        $node9->addTo($node8);
        $node9->setPassage($node5);

        $row1 = array($node1,$node2,$node3);
        $row2 = array($node4,$node5,$node6);
        $row3 = array($node7,$node8,$node9);

        $grid = array($row1,$row2,$row3);

        $node2->Block();
        $node1->searchReachable(2,0,0);
        $this->assertFalse($node1->getReachable());
        $this->assertTrue($node2->getBlock());
        $this->assertFalse($node2->getReachable());
        $this->assertFalse($node3->getReachable());
        $this->assertFalse($node4->getReachable());
        $this->assertTrue($node5->getReachable());
        $this->assertFalse($node6->getReachable());
        $this->assertTrue($node7->getReachable());
        $this->assertFalse($node8->getReachable());
        $this->assertFalse($node9->getReachable());

        foreach($grid as $row){
            foreach($row as $node){
                $node->setBlock();
            }
        }

        $node4->Block();
        $node5->searchReachable(2,1,1);
        $this->assertFalse($node1->getReachable());
        $this->assertTrue($node4->getBlock());
        $this->assertFalse($node2->getReachable());
        $this->assertFalse($node3->getReachable());
        $this->assertFalse($node4->getReachable());
        $this->assertTrue($node5->getReachable());
        $this->assertFalse($node6->getReachable());
        $this->assertFalse($node7->getReachable());
        $this->assertFalse($node8->getReachable());
        $this->assertTrue($node9->getReachable());







    }




}