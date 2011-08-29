<?php
class SequencesTest extends PhynasterTestCase
{
  public function setUp()
  {
    Phynaster_Helpers::clearSequences();
    return parent::setUp();
  }

  public function testCanDefineMultipleSequences()
  {
    $first = Phynaster_Helpers::sequence('first');
    $second = Phynaster_Helpers::sequence('second');

    $this->assertEquals(Phynaster_Helpers::getSequence('first'), 1);
    $this->assertEquals(Phynaster_Helpers::getSequence('second'), 1);
  }

  public function testInstantiatingSequenceGivesSequentialNumbers()
  {
    Phynaster::define('test', array(
      'defaults' => array(
        'number' => Phynaster::sequence()
      )
    ));

    $first = Phynaster::create('test');
    $second = Phynaster::create('test');

    $this->assertEquals($first['number'], 1);
    $this->assertEquals($second['number'], 2);
  }

  public function testSequenceCanBePartOfAString()
  {
    Phynaster::define('test', array(
      'defaults' => array(
        'name' => 'Name ' . Phynaster::sequence()
      )
    ));

    $first = Phynaster::create('test');
    $second = Phynaster::create('test');

    $this->assertEquals($first['name'], 'Name 1');
    $this->assertEquals($second['name'], 'Name 2');
  }
}
