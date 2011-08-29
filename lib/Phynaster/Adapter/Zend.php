<?php
/**
 * Integrate Phynaster with Zend_Db_Table (or classes extending from it),
 * so that Phynaster can automatically insert rows into the database when
 * creating instances from a factory.
 *
 * @module Phynaster
 */
class Phynaster_Adapter_Zend
{
  private $table;

  public function __construct($table)
  {
    if( !($table instanceof Zend_Db_Table) )
      throw new Exception_Phynaster_Adapter_Invalid_DbTable('Adapter requires a valid Zend_Db_Table');

    $this->table = new $table;
  }

  /**
   * Get the Zend_Db_Table associated with the adapter.
   * @return Zend_Db_Table
   */
  public function getTable()
  {
    return $this->table;
  }
}

class Exception_Phynaster_Adapter_Invalid_DbTable extends Exception { }
