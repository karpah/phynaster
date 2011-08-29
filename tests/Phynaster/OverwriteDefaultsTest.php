<?php
require_once 'TestCase.php';
require_once 'Phynaster.php';

class OverwriteDefaultsTest extends PhynasterTestCase
{
  public function testCanOverwritePlainDataWhenInstantiatingFactory()
  {
    Phynaster::define('test', array('defaults' => array('key' => 1)));
    $instance = Phynaster::create('test', array('key' => 2));

    $this->assertEquals($instance['key'], 2);
  }
  public function testCanOverwriteAssociationWhenInstantiatingFactory()
  {
    Phynaster::define('default_related', array('defaults' => array('id' => 1)));
    Phynaster::define('overwrite_related', array('defaults' => array('id' => 2)));

    Phynaster::define('test', array('defaults' => array('related' => Phynaster::Association('default_related'))));
    $instance = Phynaster::create('test', array('related' => Phynaster::create('overwrite_related')));

    $this->assertEquals($instance['related'], 2);
  }

  public function testDoNotInstantiateExtraFactoriesWhenOverwritingAssociations()
  {
    // This one is the killer one!
    $this->markTestIncomplete();
  }
}
