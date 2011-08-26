<?php
require_once 'TestCase.php';
require_once 'Phynaster.php';

class FactoryCreation extends PhynasterTestCase
{
  public function testCanCreateArrayFromDefaultFactoryWithPlainData()
  {
    Phynaster::define('test', array('defaults' => array('name' => 'Foo')));
    $this->assertEquals(array('name' => 'Foo'), Phynaster::create('test'));
  }

  public function testCanCreateObjectFromDefaultFactoryWithPlainData()
  {
    Phynaster::define('test', array('class' => 'ArrayObject', 'defaults' => array('name' => 'Foo')));
    $object = Phynaster::create('test');
    $this->assertInstanceOf('ArrayObject', $object);
    $this->assertEquals('Foo', $object['name']);
  }
}
