<?php
require_once 'TestCase.php';
require_once 'Phynaster.php';

class Basics extends PhynasterTestCase
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

  public function testCanClearFactories()
  {
    Phynaster::define('test', array());
    Phynaster::clearFactories();

    // This should not error as the original test factory has been cleared
    Phynaster::define('test', array());
  }
}
