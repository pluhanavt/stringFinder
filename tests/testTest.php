<?php

require "../lib/StringFinder.php";

use PHPUnit\Framework\TestCase;

class testTest extends TestCase
{
    public function testNonFirstLine()
    {
        $file = new StringFinder();
        $this->assertEquals(["line" => 5, "pos" => 16], $file->find("augue mauris"));
    }

    public function testFirstLine()
    {
        $file = new StringFinder();
        $this->assertEquals(["line" => 1, "pos" => 1], $file->find("Lorem ipsum"));
    }

    public function testNoneFound()
    {
        $file = new StringFinder();
        $this->assertEquals(false, $file->find("Lasdasdorem ipsum"));
    }

    public function testAnotherFile()
    {
        $file = new StringFinder("../files/normal_file.txt");
        $this->assertEquals(["line" => 1, "pos" => 1], $file->find("Lorem ipsum"));
    }

    public function testBigFile(){
        $file = new StringFinder("../files/big_file.txt");
        $this->assertEquals(null, $file->find("Lorem ipsum"));
    }

    public function testWrongMimeType(){
        $file = new StringFinder("../files/html.html");
        $this->assertEquals(null, $file->find("Lorem ipsum"));
    }
}
