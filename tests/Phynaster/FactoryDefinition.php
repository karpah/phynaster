<?php
require_once 'TestCase.php';
require_once 'Phynaster.php';

class FactoryDefinition extends PhynasterTestCase
{
  public function testCanCreateEmptyDefinedFactory()
  {
    Phynaster::define('test', array());
    Phynaster::create('test');
  }

  public function testDefiningFactoryReturnsFactory()
  {
    $factory = Phynaster::define('test');
    $this->assertInstanceOf('Phynaster_Factory', $factory);
  }

  public function testCanDefineFactoryWithClass()
  {
    $factory = Phynaster::define('test', array('class' => 'Object'));
    $this->assertEquals('Object', $factory->getClass());
  }

  // Eventually, factories will have the option to either instantiate and save
  // an object themselves, or simply return an array of values for something
  // else to use in instantiation
  public function testDefaultClassForFactoryIsArray()
  {
    $factory = Phynaster::define('test', array());
    $this->assertEquals('Array', $factory->getClass());
  }

}
