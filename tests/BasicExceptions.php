<?php
require_once('../lib/Phynaster.php');

class BasicExceptions extends PHPUnit_Framework_TestCase
{
  /**
   * @expectedException Exception_Phynaster_Undefined_Factory
   */
  public function testUndefinedFactoryThrowsException()
  {
    Phynaster::create('test');
  }

  /**
   * @expectedException Exception_Phynaster_Duplicate_Factory
   */
  public function testDuplicateFactoryNameThrowsException()
  {
    Phynaster::define('test', array());
    Phynaster::define('test', array());
  }
}
