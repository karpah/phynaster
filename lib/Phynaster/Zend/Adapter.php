<?php
/**
 * Integrate Phynaster with Zend_Db_Table (or classes extending from it),
 * so that Phynaster can automatically insert rows into the database when
 * creating instances from a factory.
 *
 * @module Phynaster
 */
class Phynaster_Zend_Adapter
{
  private $table;

  public function __construct($table)
  {
    if( !($table instanceof Zend_Db_Table) )
      throw new Exception_Phynaster_Zend_Adapter_Invalid_DbTable('Adapter requires a valid Zend_Db_Table');

    $this->table = new $table;
  }
}

class Exception_Phynaster_Zend_Adapter_Invalid_DbTable extends Exception { }
