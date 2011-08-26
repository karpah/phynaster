<?php
/**
 * A defined factory within Phynaster.
 *
 * @module Phynaster
 */

class Phynaster_Factory
{
  protected $class;
  protected $associations;
  protected $defaults;

  /**
   * Create the factory.
   * @param array $data
   */
  public function __construct($data)
  {
    if( array_key_exists('class', $data) )
      $this->class = $data['class'];

    if( array_key_exists('defaults', $data) )
      $this->defaults = $data['defaults'];
  }

  /**
   * Generate an instance from the factory.
   * @return mixed
   */
  public function generate()
  {
    if( $this->class )
      return new $this->class($this->defaults);
    else
      return $this->defaults;
  }


  /**
   * The type of class that will be instantiated when the factory is utilized.
   * @return string
   */
  public function getClass()
  {
    if( $this->class )
      return $this->class;
    else
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
