<?php
require_once 'TestCase.php';
require_once 'Phynaster/Adapter/Zend.php';
require_once 'Zend/Db/Table.php';
require_once 'Zend/Db/Adapter/Pdo/Sqlite.php';

$adapter = new Zend_Db_Adapter_Pdo_Sqlite(array('dbname' => 'test'));
$adapter->query("DROP TABLE IF EXISTS test;");
$adapter->query("CREATE TABLE test(id INTEGER PRIMARY KEY ASC, name VARCHAR(25))");

class MemberInsertTable extends Zend_Db_Table
{
  protected $_primary = 'id';
  protected $_name = 'test';
}

Zend_Db_Table_Abstract::setDefaultAdapter($adapter);

class InstantiateFactoryTest extends PhynasterTestCase
{
  public function testCanSaveDatabaseRecordByInstantiatingFactory()
  {
    $table = new MemberInsertTable;
    $factory = Phynaster::define('test', array('defaults' => array('name' => 'Test'), 'adapter' => Phynaster::adapter('Zend', $table)));
    $instance = Phynaster::create('test');

    // DB table should now have a record.
    $this->assertEquals(count($table->fetchAll()), 1);
  }
}
