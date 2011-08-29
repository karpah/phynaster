<?
/**
 * Defines a belongsTo association between factory objects.
 * eg. A Post belongs to a Blog - it has a blog_id field
 *
 * @module Phynaster
 */

class Phynaster_Association_BelongsTo extends Phynaster_Association
{
  protected $foreignKey;
  protected $target;

  public function __construct($target, $key='id')
  {
    $this->target = $target;
    $this->foreignKey = $key;
  }

  /**
   * Get the foreign key for the association.
   * @return string
   */
  public function foreignKey()
  {
    return $this->foreignKey;
  }

  /**
   * Get the name of the factory to be used for the association.
   * @return string
   */
  public function getFactory()
  {
    return $this->target;
  }
}
