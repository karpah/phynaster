<?php
/**
 * A defined factory within Phynaster.
 *
 * @module Phynaster
 */

require_once 'Zend/Adapter.php';

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
    if( array_key_exists('defaults', $data) )
      $this->defaults = $data['defaults'];

    if( array_key_exists('adapter', $data) )
      $this->adapter = new Phynaster_Zend_Adapter($data['adapter']);
  }

  /**
   * Generate an instance from the factory.
   * @return mixed
   */
  public function generate()
  {
    return $this->defaults;
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
}
