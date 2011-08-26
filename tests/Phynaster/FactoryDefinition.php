<?php
require_once 'Phynaster.php';

class FactoryDefinition extends PHPUnit_Framework_TestCase
{
  public function testCanCreateEmptyDefinedFactory()
  {
    Phynaster::define('test', array());
    Phynaster::create('test');
  }
}
