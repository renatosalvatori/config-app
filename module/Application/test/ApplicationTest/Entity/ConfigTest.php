<?php
/*
 * A series of tests for the Config entity
 */
namespace ApplicationTest\Config;

use ApplicationTest\Bootstrap;
use Application\Entity\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase{
  
  /**
   * Set up the class for testing. 
   */
  public function setUp(){
    $this->config = new Config();
  }
  
  /**
   * minLengthUserId tests 
   */
  public function testCanSetMinLengthUserIdToIntegerMoreThanOrEqualTo2(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserId());
   
    $config->setMinLengthUserId(2);
    $this->assertEquals(2, $config->getMinLengthUserId());
    
    $config->setMinLengthUserId(3);
    $this->assertEquals(3, $config->getMinLengthUserId());
  }
  
  public function testCannotSetMinLengthUserIdToIntegerLessThan2(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserId());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserId(1);
  }
  
  public function testCannotSetMinLengthUserIdToFloat(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserId());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserId(1.1);
  }
  
  public function testCannotSetMinLengthUserIdToString(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserId());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserId("abc");
  }
  
  public function testCannotSetMinLengthUserIdToNull(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserId());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserId(null);
  }
  
  /**
   * minLengthUserName tests 
   */
  public function testCanSetMinLengthUserNameToIntegerMoreThanOrEqualTo3(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserName());
   
    $config->setMinLengthUserName(3);
    $this->assertEquals(3, $config->getMinLengthUserName());
    
    $config->setMinLengthUserName(4);
    $this->assertEquals(4, $config->getMinLengthUserName());
  }
  
  public function testCannotSetMinLengthUserNameToIntegerLessThan3(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserName());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserName(2);
  }
  
  public function testCannotSetMinLengthUserNameToFloat(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserName());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserName(1.1);
  }
  
  public function testCannotSetMinLengthUserNameToString(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserName());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserName("abc");
  }
  
  public function testCannotSetMinLengthUserNameToNull(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserName());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserName(null);
  }
  
  /**
   * minLengthUserPassword tests
   */
  public function testCanSetMinLengthUserPasswordToIntegerMoreThanOrEqualTo4(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserPassword());
   
    $config->setMinLengthUserPassword(4);
    $this->assertEquals(4, $config->getMinLengthUserPassword());
    
    $config->setMinLengthUserPassword(5);
    $this->assertEquals(5, $config->getMinLengthUserPassword());
  }
  
  public function testCannotSetMinLengthUserPasswordToIntegerLessThan4(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserPassword());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserPassword(3);
  }
  
  public function testCannotSetMinLengthUserPasswordToFloat(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserPassword());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserPassword(1.1);
  }
  
  public function testCannotSetMinLengthUserPasswordToString(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserPassword());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserPassword("abc");
  }
  
  public function testCannotSetMinLengthUserPasswordToNull(){
    $config = $this->config;
    $this->assertNull($config->getMinLengthUserPassword());
   
    $this->setExpectedException('\Exception');
    $config->setMinLengthUserPassword(null);
  }
  
  /**
   * daysPasswordReuse tests
   */
  public function testCanSetDaysPasswordReuseToIntegerMoreThanOrEqualTo0(){
    $config = $this->config;
    $this->assertNull($config->getDaysPasswordReuse());
   
    $config->setDaysPasswordReuse(0);
    $this->assertEquals(0,$config->getDaysPasswordReuse());
    
    $config->setDaysPasswordReuse(1);
    $this->assertEquals(1,$config->getDaysPasswordReuse());
  }
  
  public function testCannotSetDaysPasswordReuseToIntegerLessThan0(){
    $config = $this->config;
    $this->assertNull($config->getDaysPasswordReuse());
   
    $this->setExpectedException('\Exception');
    $config->setDaysPasswordReuse(-1);
  }
  
  public function testCannotSetDaysPasswordReuseToFloat(){
    $config = $this->config;
    $this->assertNull($config->getDaysPasswordReuse());
   
    $this->setExpectedException('\Exception');
    $config->setDaysPasswordReuse(1.1);
  }
  
  public function testCannotDaysPasswordReuseToString(){
    $config = $this->config;
    $this->assertNull($config->getDaysPasswordReuse());
   
    $this->setExpectedException('\Exception');
    $config->setDaysPasswordReuse("abc");
  }
  
  public function testCannotSetDaysPasswordReuseToNull(){
    $config = $this->config;
    $this->assertNull($config->getDaysPasswordReuse());
   
    $this->setExpectedException('\Exception');
    $config->setDaysPasswordReuse(null);
  }  
  
  /**
   * passwordLettersAndNumbers tests
   */
  public function testCanSetPasswordLettersAndNumbersTo0(){
    $config = $this->config;
    $this->assertNull($config->getPasswordLettersAndNumbers());
   
    $config->setPasswordLettersAndNumbers(0);
    $this->assertEquals(0, $config->getPasswordLettersAndNumbers());
  }
  
  public function testCanSetPasswordLettersAndNumbersTo1(){
    $config = $this->config;
    $this->assertNull($config->getPasswordLettersAndNumbers());
   
    $config->setPasswordLettersAndNumbers(1);
    $this->assertEquals(1, $config->getPasswordLettersAndNumbers());
  }
  
  public function testCannotSetPasswordLettersAndNumbersToMoreThan1(){
    $config = $this->config;
    $this->assertNull($config->getPasswordLettersAndNumbers());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordLettersAndNumbers(2);
  }
  
  public function testCannotSetPasswordLettersAndNumbersToLessThan0(){
    $config = $this->config;
    $this->assertNull($config->getPasswordLettersAndNumbers());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordLettersAndNumbers(-1);
  }
  
  public function testCannotSetPasswordLettersAndNumbersToFloat(){
    $config = $this->config;
    $this->assertNull($config->getPasswordLettersAndNumbers());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordLettersAndNumbers(1.1);
  }
  
  public function testCannotSetPasswordLettersAndNumbersToString(){
    $config = $this->config;
    $this->assertNull($config->getPasswordLettersAndNumbers());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordLettersAndNumbers("abc");
  }
  
  public function testCannotSetPasswordLettersAndNumbersToNull(){
    $config = $this->config;
    $this->assertNull($config->getPasswordLettersAndNumbers());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordLettersAndNumbers(null);
  } 
  
  /**
   * passwordUpperLower tests
   */
  public function testCanSetPasswordUpperLowerTo0(){
    $config = $this->config;
    $this->assertNull($config->getPasswordUpperLower());
   
    $config->setPasswordUpperLower(0);
    $this->assertEquals(0, $config->getPasswordUpperLower());
  }
  
  public function testCanSetPasswordUpperLowerTo1(){
    $config = $this->config;
    $this->assertNull($config->getPasswordUpperLower());
   
    $config->setPasswordUpperLower(1);
    $this->assertEquals(1, $config->getPasswordUpperLower());
  }
  
  public function testCannotSetPasswordUpperLowerToIntegerMoreThan1(){
    $config = $this->config;
    $this->assertNull($config->getPasswordUpperLower());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordUpperLower(2);
  }
  
  public function testCannotSetPasswordUpperLowerToIntegerLessThan0(){
    $config = $this->config;
    $this->assertNull($config->getPasswordUpperLower());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordUpperLower(-1);
  }
  
  public function testCannotSetPasswordUpperLowerToFloat(){
    $config = $this->config;
    $this->assertNull($config->getPasswordUpperLower());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordUpperLower(1.1);
  }
  
  public function testCannotSetPasswordUpperLowerToString(){
    $config = $this->config;
    $this->assertNull($config->getPasswordUpperLower());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordUpperLower("abc");
  }
  
  public function testCannotSetPasswordUpperLowerToNull(){
    $config = $this->config;
    $this->assertNull($config->getPasswordUpperLower());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordUpperLower(null);
  }
  
  /**
   * maxFailedLogins tests
   */
  public function testCanSetMaxFailedLoginsToIntegerMoreThanOrEqualTo1(){
    $config = $this->config;
    $this->assertNull($config->getMaxFailedLogins());
   
    $config->setMaxFailedLogins(1);
    $this->assertEquals(1, $config->getMaxFailedLogins());
    $config->setMaxFailedLogins(2);
    $this->assertEquals(2, $config->getMaxFailedLogins());
  }
  
  public function testCannotSetMaxFailedLoginsToIntegerLessThan1(){
    $config = $this->config;
    $this->assertNull($config->getMaxFailedLogins());
   
    $this->setExpectedException('\Exception');
    $config->setMaxFailedLogins(0);
  }
  
  public function testCannotSetMaxFailedLoginsToFloat(){
    $config = $this->config;
    $this->assertNull($config->getMaxFailedLogins());
   
    $this->setExpectedException('\Exception');
    $config->setMaxFailedLogins(1.1);
  }
  
  public function testCannotSetMaxFailedLoginsToString(){
    $config = $this->config;
    $this->assertNull($config->getMaxFailedLogins());
   
    $this->setExpectedException('\Exception');
    $config->setMaxFailedLogins("abc");
  }
  
  public function testCannotSetMaxFailedLoginsToNull(){
    $config = $this->config;
    $this->assertNull($config->getMaxFailedLogins());
   
    $this->setExpectedException('\Exception');
    $config->setMaxFailedLogins(null);
  }
  
  /**
   * passwordValidity tests
   */
  public function testCanSetPasswordValidityToIntegerMoreThanOrEqualTo2(){
    $config = $this->config;
    $this->assertNull($config->getPasswordValidity());
   
    $config->setPasswordValidity(2);
    $this->assertEquals(2, $config->getPasswordValidity());
    
    $config->setPasswordValidity(3);
    $this->assertEquals(3, $config->getPasswordValidity());
  }
  
  public function testCannotSetPasswordValidityToIntegerLessThan2(){
    $config = $this->config;
    $this->assertNull($config->getPasswordValidity());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordValidity(1);
  }
  
  public function testCannotSetPasswordValidityToFloat(){
    $config = $this->config;
    $this->assertNull($config->getPasswordValidity());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordValidity(1.1);
  }
  
  public function testCannotSetPasswordValidityToString(){
    $config = $this->config;
    $this->assertNull($config->getPasswordValidity());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordValidity("abc");
  }
  
  public function testCannotSetPasswordValidityToNull(){
    $config = $this->config;
    $this->assertNull($config->getPasswordValidity());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordValidity(null);
  }
  
  /**
   * passwordExpiryDays tests
   */
  public function testCanSetPasswordExpiryDaysToIntegerMoreThanOrEqualTo2(){
    $config = $this->config;
    $this->assertNull($config->getPasswordExpiryDays());
   
    $config->setPasswordExpiryDays(2);
    $this->assertEquals(2, $config->getPasswordExpiryDays());
    
    $config->setPasswordExpiryDays(3);
    $this->assertEquals(3, $config->getPasswordExpiryDays());
  } 
  
  public function testCannotSetPasswordExpiryDaysToIntegerLessThan2(){
    $config = $this->config;
    $this->assertNull($config->getPasswordExpiryDays());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordExpiryDays(1);
  }
  
  public function testCannotSetPasswordExpiryDaysToFloat(){
    $config = $this->config;
    $this->assertNull($config->getPasswordExpiryDays());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordExpiryDays(1.1);
  }
  
  public function testCannotSetPasswordExpiryDaysToString(){
    $config = $this->config;
    $this->assertNull($config->getPasswordExpiryDays());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordExpiryDays("abc");
  }
  
  public function testCannotSetPasswordExpiryDays(){
    $config = $this->config;
    $this->assertNull($config->getPasswordExpiryDays());
   
    $this->setExpectedException('\Exception');
    $config->setPasswordExpiryDays(null);
  }
  
  /**
   * timeout tests
   */
  public function testCanSetTimeoutToIntegerMoreThanOrEqualTo1(){
    $config = $this->config;
    $this->assertNull($config->getTimeout());
   
    $config->setTimeout(1);
    $this->assertEquals(1, $config->getTimeout());
    
    $config->setTimeout(2);
    $this->assertEquals(2, $config->getTimeout());
  }
  
  public function testCannotSetTimeoutToIntegerLessThan1(){
    $config = $this->config;
    $this->assertNull($config->getTimeout());
   
    $this->setExpectedException('\Exception');
    $config->setTimeout(0);
  }
  
  public function testCannotSetTimeoutToFloat(){
    $config = $this->config;
    $this->assertNull($config->getTimeout());
   
    $this->setExpectedException('\Exception');
    $config->setTimeout(1.1);
  }
  
  public function testCannotSetTimeoutToString(){
    $config = $this->config;
    $this->assertNull($config->getTimeout());
   
    $this->setExpectedException('\Exception');
    $config->setTimeout("abc");
  }
  
  public function testCannotSetTimeoutToNull(){
    $config = $this->config;
    $this->assertNull($config->getTimeout());
   
    $this->setExpectedException('\Exception');
    $config->setTimeout(null);
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