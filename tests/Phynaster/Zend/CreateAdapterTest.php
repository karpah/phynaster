<?php
require_once 'TestCase.php';
require_once 'Phynaster/Adapter/Zend.php';
require_once 'Zend/Db/Table.php';
require_once 'Zend/Db/Adapter/Pdo/Sqlite.php';

class MemberTable extends Zend_Db_Table {}
$adapter = new Zend_Db_Adapter_Pdo_Sqlite(array('dbname' => 'test'));
Zend_Db_Table_Abstract::setDefaultAdapter($adapter);

class CreateAdapterTest extends PhynasterTestCase
{

  public function testCanSupplyZendAdapterForFactoryDefinition()
  {
    $factory = Phynaster::define('test', array('adapter' => Phynaster::adapter('Zend', new MemberTable)));
    $adapter = $factory->getAdapter();
    $this->assertInstanceOf('Phynaster_Adapter_Zend', $adapter);
    $this->assertInstanceOf('MemberTable', $adapter->getTable());
  }

  /**
   * @expectedException Exception_Phynaster_Adapter_Invalid_DbTable
   */
  public function testAdapterRequiresADbTable()
  {
    $adapter = new Phynaster_Adapter_Zend('test');
  }
}
