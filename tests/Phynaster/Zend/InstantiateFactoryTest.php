<?php
require_once 'TestCase.php';
require_once 'Phynaster/Adapter/Zend.php';
require_once 'Zend/Db/Table.php';
require_once 'Zend/Db/Adapter/Pdo/Sqlite.php';


class AssocTable extends Zend_Db_Table
{
  protected $_primary = 'id';
  protected $_name = 'assoc';
}

class BaseTable extends Zend_Db_Table
{
  protected $_primary = 'id';
  protected $_name = 'base';
}

class InstantiateFactoryTest extends PhynasterTestCase
{

  public function setUp()
  {
    $adapter = new Zend_Db_Adapter_Pdo_Sqlite(array('dbname' => 'test'));
    $adapter->query("DROP TABLE IF EXISTS assoc;");
    $adapter->query("DROP TABLE IF EXISTS base;");
    $adapter->query("CREATE TABLE base(id INTEGER PRIMARY KEY ASC, name VARCHAR(25))");
    $adapter->query("CREATE TABLE assoc(id INTEGER PRIMARY KEY ASC, base_id INTEGER, name VARCHAR(25))");

    Zend_Db_Table_Abstract::setDefaultAdapter($adapter);
    return parent::setUp();
  }

  public function testCanSaveDatabaseRecordByInstantiatingFactory()
  {
    $table = new BaseTable;
    Phynaster::define('base', array('defaults' => array('name' => 'Test'), 'adapter' => Phynaster::adapter('Zend', $table)));
    Phynaster::create('base');

    // DB table should now have a record.
    $this->assertEquals(count($table->fetchAll()), 1);
  }

  public function testCanSaveMultipleDatabaseRecordsByInstantiatingFactoryWithAssociation()
  {
    $assocTable = new AssocTable;
    $baseTable = new BaseTable;

    Phynaster::define('base', array('defaults' => array('name' => 'Test'), 'adapter' => Phynaster::adapter('Zend', $baseTable)));
    Phynaster::define('assoc', array(
      'defaults' => array('name' => 'Test', 'base_id' => Phynaster::association('base')),
      'adapter' => Phynaster::adapter('Zend', $assocTable)));

    Phynaster::create('assoc');

    // Both DB tables should now have records.
    $this->assertEquals(count($assocTable->fetchAll()), 1);
    $this->assertEquals(count($baseTable->fetchAll()), 1);

    // And the db value for base.test_id should equal the value for test.id
    $baseRecord = $baseTable->fetchAll()->current();
    $assocRecord = $assocTable->fetchAll()->current();
    $this->assertEquals($assocRecord['base_id'], $baseRecord['id']);
  }

  public function testOverwritingAssociationDoesNotCreateMultipleDatabaseRecords()
  {
    // Very similar to previous test, except for...
    $assocTable = new AssocTable;
    $baseTable = new BaseTable;

    Phynaster::define('base', array('defaults' => array('name' => 'Test'), 'adapter' => Phynaster::adapter('Zend', $baseTable)));
    Phynaster::define('assoc', array(
      'defaults' => array('name' => 'Test', 'base_id' => Phynaster::association('base')),
      'adapter' => Phynaster::adapter('Zend', $assocTable)));

    // This line!
    Phynaster::create('assoc', array('base_id' => Phynaster::create('base', array('name' => 'Not the default'))));

    // Both DB tables should now have records.
    $this->assertEquals(count($assocTable->fetchAll()), 1);
    $this->assertEquals(count($baseTable->fetchAll()), 1);

    // And the created record for the base table should be the overwritten one, not the default
    $baseRecord = $baseTable->fetchAll()->current();
    $this->assertEquals('Not the default', $baseRecord['name']);
  }
}
