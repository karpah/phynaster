<?php
class GuidTest extends PhynasterTestCase
{
  public function setUp()
  {
    Phynaster_Helpers::clearSequences();
    return parent::setUp();
  }

  public function testCanGenerateAGuid()
  {
    $this->assertEquals(Phynaster_Helpers::getGuid(), '00000000-0000-0000-0000-000000000001');
  }

  public function testCanGenerateSequentalGuids()
  {
    $this->assertEquals(Phynaster_Helpers::getGuid(), '00000000-0000-0000-0000-000000000001');
    $this->assertEquals(Phynaster_Helpers::getGuid(), '00000000-0000-0000-0000-000000000002');
  }

  public function testUsesHexadecimalCharactersInGuids()
  {
    for($i=1; $i<11; $i++)
      Phynaster_Helpers::getGuid();

    // The 11th GUID should be 000B
    $this->assertEquals(Phynaster_Helpers::getGuid(), '00000000-0000-0000-0000-00000000000B');
  }

  public function testCanUseAGuidInAFactory()
  {
    Phynaster::define('test', array('defaults' => array('guid' => Phynaster::guid())));
    $instance = Phynaster::create('test');
    $this->assertEquals($instance['guid'], '00000000-0000-0000-0000-000000000001');
  }
}
