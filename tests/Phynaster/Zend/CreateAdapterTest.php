<?php
require_once 'TestCase.php';
require_once 'Phynaster/Zend/Adapter.php';

class CreateAdapterTest extends PhynasterTestCase
{
  /**
   * @expectedException Exception_Phynaster_Zend_Adapter_Invalid_DbTable
   */
  public function testAdapterRequiresADbTable()
  {
    $adapter = new Phynaster_Zend_Adapter('test');
  }
}
