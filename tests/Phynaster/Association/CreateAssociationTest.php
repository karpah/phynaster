<?php
require_once 'TestCase.php';
require_once 'Phynaster.php';

class CreateAssociationTest extends PhynasterTestCase
{
  public function testBelongsToAssociationDefaultKeyIsId()
  {
    $factory = Phynaster::define('test', array('defaults' => array('id' => 1)));
    $association = new Phynaster_Association_BelongsTo('test');

    $this->assertEquals($association->foreignKey(), 'id');
  }

  public function testCanSetForeignKeyFieldForAssociation()
  {
    $factory = Phynaster::define('test', array('defaults' => array('foo' => 1)));
    $association = new Phynaster_Association_BelongsTo('test', 'foo');

    $this->assertEquals($association->foreignKey(), 'foo');
  }
}
