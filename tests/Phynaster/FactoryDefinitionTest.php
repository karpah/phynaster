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

  public function testCanSupplyDefaultDataForFactory()
  {
    $factory = Phynaster::define('test', array('defaults' => array('name' => 'Foo')));
    $this->assertEquals(array('name' => 'Foo'), $factory->getDefaults());
  }

  public function testCanDefineAssociationForDefaults()
  {
    $association = Phynaster::define('association', array('defaults' => array('id' => 1)));
    $base = Phynaster::define('test', array('defaults' => array('association' => Phynaster::association('association'))));

    $instance = Phynaster::create('test');
    $this->assertEquals($instance['association'], 1);
  }
}
