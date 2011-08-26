<?php
require_once 'Phynaster.php';

class PhynasterTestCase extends PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    Phynaster::clearFactories();
    return parent::setUp();
  }
}
