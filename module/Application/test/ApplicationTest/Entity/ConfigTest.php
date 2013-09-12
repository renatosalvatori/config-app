<?php
/*
 * A series of tests for the Config entity
 */
namespace ApplicationTest\Config;

use ApplicationTest\Bootstrap;
use Application\Entity\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase{

  public function testCannotSetMinLengthUserIdToLessThan2(){
    $config = new Config();
    $this->assertNull($config->getMinLengthUserId());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserId(1.1);
  }
}