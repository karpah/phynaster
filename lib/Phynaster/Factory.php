<?php
/**
 * A defined factory within Phynaster.
 *
 * @module Phynaster
 */

require_once 'Association.php';

class Phynaster_Factory
{
  protected $associations;
  protected $defaults;
  protected $adapter;

  /**
   * Create the factory.
   * @param array $data
   */
  public function __construct($data)
  {
    $this->defaults = array();
    if( array_key_exists('defaults', $data) )
      $this->defaults = $data['defaults'];

    if( array_key_exists('adapter', $data) )
    {
      $this->adapter = $data['adapter'];
    }
  }

  /**
   * Generate an instance from the factory.
   * @param array $data Any data to overwrite the factory's default values.
   * @return mixed
   */
  public function generate($data)
  {
    // When overwriting the default values, we may nuke any information about
    // foreign keys for associations - store those first
    $keys = array();
    foreach( $this->defaults as $default => $value )
    {
      if( $value instanceof Phynaster_Association )
      {
        $keys[$default] = $value->foreignKey();
      }
    }

    // Now we can safely merge the data without losing anything.
    $instanceValues = array_merge($this->defaults, $data);
    foreach( $instanceValues as $key => $value )
    {
      // The default association value is an instance of Association
      if( $value instanceof Phynaster_Association )
      {
        $association = Phynaster::create($value->getFactory());
        $instanceValues[$key] = $association[$value->foreignKey()];
      }
      // Any overwritten associations will be arrays
      else if( is_array($value) )
      {
        // Pull the right value out of the array we calculated earlier
        $instanceValues[$key] = $value[$keys[$key]];
      }
    }

    // Utilize the adapter if one was specified
    if( $this->adapter )
      return $this->adapter->generate($instanceValues);
    else
      return $instanceValues;
  }


  /**
   * The type of class that will be instantiated when the factory is utilized.
   * @return string
   */
  public function getClass()
  {
    return 'Array';
  }

  /**
   * Get the default data of this factory.
   * @return array|null
   */
  public function getDefaults()
  {
    return $this->defaults;
  }

  /**
   * Get the adapter defined for this factory (if any)
   * @return mixed
   */
  public function getAdapter()
  {
    return $this->adapter;
  }
}
