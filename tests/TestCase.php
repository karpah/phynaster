<?php
require_once 'Phynaster.php';

abstract class PhynasterTestCase extends PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    Phynaster::clearFactories();
    return parent::setUp();
  }
}
