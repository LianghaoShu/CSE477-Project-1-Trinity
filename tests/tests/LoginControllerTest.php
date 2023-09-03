<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 4/7/2019
 * Time: 2:27 PM
 */

class LoginControllerTest extends \PHPUnit\Framework\TestCase
{

    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Game\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }



    protected function setUp() {
        $users = new Game\Users(self::$site);
        $tableName = $users->getTableName();

        $sql = <<<SQL
delete from $tableName;
insert into $tableName(id, email, name, password, joined,salt)
values (7, "dudess@dude.com", "Dudess, The", 
        "49506d29656ad62805497b221a6bedacc304ad6496997f17fb39431dd462cf48", 
        "2015-01-22 23:50:26","Nohp6^v\$m(`qm#\$o"),
        (8, "cbowen@cse.msu.edu", "Owen, Charles",
        "14831e3f21b423a557a0aa99a391a57a2400ef0fdade328890c9048ad3a8ab6a", 
        "2015-01-01 23:50:26","aeLWK6k`jzPpgZMi"),
        (9, "bart@bartman.com", "Simpson, Bart",
        "a747a49bf74523c1760f649707bf3d2b4a858f088520fd98b35def1e6929ca26", 
        "2015-02-01 01:50:26","7xNhdV-8P#\$p)1c9"),
        (10, "marge@bartman.com", "Simpson, Marge",
        "edfc83ceca3a49aef204cee0e51eeb1728f728c56b2ea9037017230cc39ae938", 
        "2015-02-01 01:50:26",'!yhLrEo3d8vD_LNV')
SQL;

        self::$site->pdo()->query($sql);
    }


    public function test_construct() {
        $session = array();	// Fake session
        $root = self::$site->getRoot();

        // Valid staff login
        $controller = new Game\LoginController(self::$site, $session,
            array("email" => "cbowen@cse.msu.edu", "password" => "super477"));

        $this->assertEquals("Owen, Charles", $session[Game\User::SESSION_NAME]->getName());
        $this->assertEquals("$root/newgame.php?uid=8", $controller->getRedirect());

        // Valid client login
        $controller = new Game\LoginController(self::$site, $session,
            array("email" => "bart@bartman.com", "password" => "bart477"));

        $this->assertEquals("Simpson, Bart", $session[Game\User::SESSION_NAME]->getName());
        $this->assertEquals("$root/newgame.php?uid=9", $controller->getRedirect());

        // Invalid login
        $controller = new Game\LoginController(self::$site, $session,
            array("email" => "bart@bartman.com", "password" => "wrongpassword"));

        $this->assertNull($session[Game\User::SESSION_NAME]);
        $this->assertEquals("$root?e", $controller->getRedirect());
    }

}