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
}
