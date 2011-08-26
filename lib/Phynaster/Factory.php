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

  public function getClass()
  {
    if( $this->class )
      return $this->class;
    else
      return 'Array';
  }

  public function getDefaults()
  {
    return $this->defaults;
  }
}
