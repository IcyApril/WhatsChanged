<?php
/**
 * Created by PhpStorm.
 * User: junade
 * Date: 14/05/2017
 * Time: 05:12
 */

use IcyApril\WhatsChanged\Git;

class GitTest extends \PHPUnit\Framework\TestCase
{
    public function testGitExists()
    {
        $git = new Git();
        $this->assertTrue($git->gitExists());
        $git->getChangedFiles();

        $this->expectException(\IcyApril\WhatsChanged\GitException::class);
        $git = new Git("/usr/bin/gitdoesntexist");
    }
}
