<?php
/**
 * Created by PhpStorm.
 * User: junade
 * Date: 14/05/2017
 * Time: 05:01
 */

namespace IcyApril\WhatsChanged;


class WhatsChanged
{
    private $VCS;

    public function __construct(VCS $VCS)
    {
        $this->VCS = $VCS;
    }

    public function testChanges()
    {
        $changes = $this->VCS->getChangedFiles();
        $testFiles = $this->getTestFiles($changes);

        $mask = "%-30s %-30s\n";

        $fails = array();

        foreach ($testFiles as $file) {
            $exec = exec("./vendor/bin/phpunit " . $file, $full);

            if (strpos($exec, 'OK ') !== false) {
                printf($mask, $file, $exec);
            } else {
                printf($mask, $file, 'FAIL - '.$exec);
                array_push($fails, implode(PHP_EOL, $full));
            }
        }

        if (!empty($fails)) {
            echo PHP_EOL.PHP_EOL."FAILED TEST OUTPUTS:".PHP_EOL.PHP_EOL.implode(" ", $fails).PHP_EOL.PHP_EOL;
        }
    }

    public function getTestFiles(array $changes): array
    {
        $files = array();

        foreach ($changes as $change) {
            $testFile = $this->getTestFile($change);
            if (strlen($testFile) > 0) {
                array_push($files, $testFile);
            }
        }
        return array_unique($files);
    }

    public function isWatchedFile(string $file): bool
    {
        $file = strtolower($file);

        $needle = ".php";
        $length = strlen($needle);

        if ((substr($file, -$length) === $needle) === false) {
            return false;
        }

        if (substr($file, 0, 6) === "tests/") {
            return true;
        }

        if (substr($file, 0, 4) === "src/") {
            return true;
        }

        return false;
    }

    public function getTestFile(string $file)
    {
        if (!$this->isWatchedFile($file)) {
            return "";
        }

        if (substr($file, 0, 6) === "tests/") {
            return $file;
        }

        return $this->turnIntoTestFile($file);
    }

    private function turnIntoTestFile(string $file): string
    {
        $pos = strpos($file, "src/");

        if ($pos !== false) {
            $file = substr_replace($file, "tests/", $pos, strlen("src/"));
        }

        $pos = strrpos($file, ".php");

        if ($pos !== false) {
            $newFile = substr_replace($file, "Test.php", $pos, strlen(".php"));
        }

        if (!file_exists($newFile)) {
            return "";
        }

        return $newFile;

    }
}