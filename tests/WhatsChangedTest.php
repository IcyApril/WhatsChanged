<?php
/**
 * Created by PhpStorm.
 * User: junade
 * Date: 14/05/2017
 * Time: 06:55
 */

use IcyApril\WhatsChanged\WhatsChanged;
use PHPUnit\Framework\TestCase;

class WhatsChangedTest extends TestCase
{
    public function testIsPHPFile()
    {
        $whatsChanged = new WhatsChanged(new \IcyApril\WhatsChanged\Git());
        $this->assertTrue($whatsChanged->isWatchedFile("src/Git.php"));
        $this->assertTrue($whatsChanged->isWatchedFile("tests/GitTest.php"));
        $this->assertTrue($whatsChanged->isWatchedFile("src/file.test.php"));

        $this->assertFalse($whatsChanged->isWatchedFile("file.txt"));
        $this->assertFalse($whatsChanged->isWatchedFile("file.phps"));
        $this->assertFalse($whatsChanged->isWatchedFile("file.php"));
    }

    public function testGetTestFile()
    {
        $whatsChanged = new WhatsChanged(new \IcyApril\WhatsChanged\Git());

        $this->assertEquals("tests/Git.php", $whatsChanged->getTestFile("tests/Git.php"));
        $this->assertEquals("tests/GitTest.php", $whatsChanged->getTestFile("src/Git.php"));
    }
}
