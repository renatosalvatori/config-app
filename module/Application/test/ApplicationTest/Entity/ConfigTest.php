<?php
/*
 * A series of tests for the Config entity
 */
namespace ApplicationTest\Config;

use ApplicationTest\Bootstrap;
use Application\Entity\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase{
  
  /**
   * @var Application\Entity\Config 
   */
  protected $config;
  
  /**
   * Set up the class for testing. 
   */
  public function setUp(){
    $this->config = new Config();
  }
  
  /**
   * A data provider which submits a range of values to each of my checking functions
   * @return type 
   */
  public function dataProvider(){
    return array(
      array(-1),  
      array(0),  
      array(1),  
      array(2),  
      array(3),  
      array(4),  
      array(5),  
      array(1.1),  
      array("abc"),  
      array(true),  
      array(false),
      array(null),
    );
  }
  
  /**
   * @dataProvider dataProvider
   */
  public function testCanOnlySetMinLengthUserIdToIntegerMoreThanOrEqualTo2($x){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserId());
    
    if(!is_integer($x) || $x < 2){
      $this->setExpectedException('\Exception');
    }
    
    $config->setMinLengthUserId($x);
    $this->assertEquals($x, $config->getMinLengthUserId());
  }
  
  /**
   * @dataProvider dataProvider
   */
  public function testCanOnlySetMinLengthUserNameToIntegerMoreThanOrEqualTo3($x){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserName());
    
    if(!is_integer($x) || $x < 3){
      $this->setExpectedException('\Exception');
    }
    
    $config->setMinLengthUserName($x);
    $this->assertEquals($x, $config->getMinLengthUserName());
  }
  
  /**
   * @dataProvider dataProvider
   */
  public function testCanOnlySetMinLengthUserPasswordToIntegerMoreThanOrEqualTo4($x){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserPassword());
    
    if(!is_integer($x) || $x < 4){
      $this->setExpectedException('\Exception');
    }
    
    $config->setMinLengthUserPassword($x);
    $this->assertEquals($x, $config->getMinLengthUserPassword());
  }
  
  /**
   * @dataProvider dataProvider
   */
  public function testCanOnlySetDaysPasswordReuseToIntegerMoreThanOrEqualTo0($x){
    $config = $this->config;
    $this->assertNull($config->getDaysPasswordReuse());
    
    if(!is_integer($x) || $x < 0){
      $this->setExpectedException('\Exception');
    }
    
    $config->setDaysPasswordReuse($x);
    $this->assertEquals($x, $config->getDaysPasswordReuse());
  }
  
  /**
   * @dataProvider dataProvider
   */
  public function testCanOnlySetPasswordLettersAndNumbersTo0Or1($x){
    $config = $this->config;
    $this->assertNull($config->getPasswordLettersAndNumbers());
    
    //if it is not an integer or a boolean, expect an exception to be thrown.
    //if it is an integer and it is not 0 or 1 then expect an exception to be thrown.
    if(!is_integer($x) || ($x!==0 && $x!==1)){
      $this->setExpectedException('\Exception');
    }
    
    $config->setPasswordLettersAndNumbers($x);
    $this->assertEquals($x, $config->getPasswordLettersAndNumbers());
  }
  
  /**
   * @dataProvider dataProvider
   */
  public function testCanOnlySetPasswordUpperLowerTo0Or1($x){
    $config = $this->config;
    $this->assertNull($config->getPasswordUpperLower());
    
    if(!is_integer($x) || ($x!==0 && $x!==1)){
      $this->setExpectedException('\Exception');
    }
    
    $config->setPasswordUpperLower($x);
    $this->assertEquals($x, $config->getPasswordUpperLower());
  }
  
  /**
   * @dataProvider dataProvider
   */
  public function testCanOnlySetMaxFailedLoginsToIntegerMoreThanOrEqualTo1($x){
    $config = $this->config;
    $this->assertNull($config->getMaxFailedLogins());
    
    if(!is_integer($x) || $x < 1){
      $this->setExpectedException('\Exception');
    }
    
    $config->setMaxFailedLogins($x);
    $this->assertEquals($x, $config->getMaxFailedLogins());
  }
  
  /**
   * @dataProvider dataProvider
   */
  public function testCanOnlySetPasswordValidityToIntegerMoreThanOrEqualTo2($x){
    $config = $this->config;
    $this->assertNull($config->getPasswordValidity());
    
    if(!is_integer($x) || $x < 2){
      $this->setExpectedException('\Exception');
    }
    
    $config->setPasswordValidity($x);
    $this->assertEquals($x, $config->getPasswordValidity());
  }
  
  /**
   * @dataProvider dataProvider
   */
  public function testCanOnlySetPasswordExpiryDaysToIntegerMoreThanOrEqualTo2($x){
    $config = $this->config;
    $this->assertNull($config->getPasswordExpiryDays());
    
    if(!is_integer($x) || $x < 2){
      $this->setExpectedException('\Exception');
    }
    
    $config->setPasswordExpiryDays($x);
    $this->assertEquals($x, $config->getPasswordExpiryDays());
  }
  
  /**
   * @dataProvider dataProvider
   */
  public function testCanOnlySetTimeoutToIntegerMoreThanOrEqualTo1($x){
    $config = $this->config;
    $this->assertNull($config->getTimeout());
    
    if(!is_integer($x) || $x < 1){
      $this->setExpectedException('\Exception');
    }
    
    $config->setTimeout($x);
    $this->assertEquals($x, $config->getTimeout());
  }
  
  /**
   * toArray tests
   */
  public function testToArrayReturnsArray(){
    $config = $this->config;
    
    $config->setTimeout(5);
    
    $array = $config->toArray();
    
    $this->assertTrue(is_array($array));
    
    $this->assertEquals($array['timeout'], $config->getTimeout());
  }
  
  /**
   * fromArray tests 
   */
  public function testFromArrayReturnsConfig(){
    $config = $this->config;
    
    $data = array(
      'minLengthUserId' => 2,
      'minLengthUserName' => 3,
      'minLengthUserPassword' => 4,
      'daysPasswordReuse' => 1,
      'passwordLettersAndNumbers' => 1,
      'passwordUpperLower' => 1,
      'maxFailedLogins' => 1,
      'passwordValidity' => 3,
      'passwordExpiryDays' => 2,
      'timeout' => 3  
    );
    
    $ret = $config->fromArray($data);
    
    $this->assertEquals('Application\Entity\Config',get_class($ret));
    $this->assertEquals($data['minLengthUserId'], $config->getMinLengthUserId());
    $this->assertEquals($data['minLengthUserName'], $config->getMinLengthUserName());
    $this->assertEquals($data['minLengthUserPassword'], $config->getMinLengthUserPassword());
    $this->assertEquals($data['daysPasswordReuse'], $config->getDaysPasswordReuse());
    $this->assertEquals($data['passwordLettersAndNumbers'], $config->getPasswordLettersAndNumbers());
    $this->assertEquals($data['passwordUpperLower'], $config->getPasswordUpperLower());
    $this->assertEquals($data['maxFailedLogins'], $config->getMaxFailedLogins());
    $this->assertEquals($data['passwordValidity'], $config->getPasswordValidity());
    $this->assertEquals($data['passwordExpiryDays'], $config->getPasswordExpiryDays());
    $this->assertEquals($data['timeout'], $config->getTimeout());
    
  }
  
  public function testFromArrayThrowsExceptionWhenInvalidData(){
    $config = $this->config;
    
    $data = array(
      'minLengthUserId' => -1,
      'minLengthUserName' => 3,
      'minLengthUserPassword' => 4,
      'daysPasswordReuse' => 1,
      'passwordLettersAndNumbers' => 1,
      'passwordUpperLower' => 1,
      'maxFailedLogins' => 1,
      'passwordValidity' => 3,
      'passwordExpiryDays' => 2,
      'timeout' => 3  
    );
    
    $this->setExpectedException('\Exception');
    $config->fromArray($data);
  }
  
  public function testFromArrayThrowsExceptionWhenTryToSetNonColumn(){
    $config = $this->config;
    
    $data = array(
      'aColumnThatDoesntExist' => -1,
    );
    
    $this->setExpectedException('\ReflectionException');
    $config->fromArray($data);
  }
}