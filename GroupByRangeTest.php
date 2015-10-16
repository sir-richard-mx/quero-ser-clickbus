<?php 
    include "GroupByRange.php";
    class GroupByRangeTest extends PHPUnit_Framework_TestCase
    {
        public $testGroup=null;
        public function setUp(){
            $this->testGroup=new GroupByRange();
            $this->testGroup->range=10;
        }
        public function tearDown(){ }
        public function testNullRange()
        {
            $this->testGroup->range=NULL;
            $this->assertSame( $this->testGroup->ranges() , [] ); 
        }
        public function testException()
        {
            $this->setExpectedException('InvalidArgumentException');
            $this->testGroup->ranges(10, 1, 'A',  14, 99, 133, 19, 20, 117, 22, 93,  120, 131);
            
        }
        public function testRanges()
        {
            $this->testGroup->range=15;
            $this->ranges(10, 1, -20,  14, 99, 136, 19, 20, 117, 22, 93, 120, 131);
            $this->assertSame( $this->testGroup->ranges() , [ [-20], [1, 10, 14], [19, 20, 22], [93, 99], [117, 120], [131], [136] ] );
        }
    }
?>
