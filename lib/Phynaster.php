<?php
/**
 * The base Phynaster class. Used as a static class for creating and generating
 * factories.
 *
 * @module Phynaster
 */

require_once 'Phynaster/Factory.php';
require_once 'Phynaster/Association.php';

class Phynaster
{
  private static $factories;

  /**
   * Define a new factory, which can then be instantiated using
   * Phynaster::create.
   * @param string $name
   * @param array $data
   */
  public static function define($name, $data=NULL)
  {
    self::initializeFactories();

    if( array_key_exists($name, self::$factories) )
      throw new Exception_Phynaster_Duplicate_Factory('Factory ' . $name . ' is already defined.');

    if( is_null($data) )
      $data = array();

    self::$factories[$name] = new Phynaster_Factory($data);
    return self::$factories[$name];
  }

  /**
   * Create a instance of the factory.
   * @param string $name
   * @return mixed
   */
  public static function create($name)
  {
    self::initializeFactories();

    if( !array_key_exists($name, self::$factories) )
      throw new Exception_Phynaster_Undefined_Factory('Factory ' . $name . ' is not defined.');

    return self::$factories[$name]->generate();
  }

  /**
   * Generate a database adapter for a factory.
   * @param string $type The type of adapter to define. 'Zend' is the only currently supported value.
   * @param mixed $table A concrete instance of the database interface. For Zend adapters, a class extending Zend_Db_Table.
   */
  public static function adapter($type, $table)
  {
    if( $type == 'Zend' )
    {
      require_once 'Phynaster/Adapter/Zend.php';
      return new Phynaster_Adapter_Zend($table);
    }
    else
    {
      throw new Exception_Phynaster_Undefined_Adapter('Undefined database adapter supplied: ' . $type);
    }
  }

  /**
   * Define a new association for a factory.
   * Default association type is belongsTo.
   *
   * @param string $factory The name of a previously defined factory that the association will be connected to.
   * @param array $extras Any extra information for the association
   * @param string $type The type of the association.
   * @returns Phynaster_Association
   */
  public static function association($factory, $key='id', $type=Phynaster_Association::BELONGS_TO)
  {
    self::initializeFactories();

    if( !array_key_exists($factory, self::$factories) )
      throw new Exception_Phynaster_Undefined_Factory('Factory ' . $factory . ' is not defined.');

    switch($type)
    {
      case Phynaster_Association::BELONGS_TO:
        return new Phynaster_Association_BelongsTo($factory, $key);
      default:
        throw new Exception_Phynaster_Association_Undefined_Type('Undefined association type - ' . (string)$type);
    }
  }

  /**
   * Clear all defined factories.
   */
  public function clearFactories()
  {
    self::$factories = array();
  }

  // Make sure the factory array is initialized.
  private function initializeFactories()
  {
    if( !isset(self::$factories) )
    {
      self::$factories = array();
    }
  }
}

class Exception_Phynaster_Duplicate_Factory extends Exception {}
class Exception_Phynaster_Undefined_Factory extends Exception {}
class Exception_Phynaster_Undefined_Adapter extends Exception {}
class Exception_Phynaster_Association_Undefined_Type extends Exception {}
