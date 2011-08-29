<?
/**
 * Defines a belongsTo association between factory objects.
 * eg. A Post belongs to a Blog - it has a blog_id field
 *
 * @module Phynaster
 */

class Phynaster_Association_BelongsTo
{
  protected $foreignKey;

  public function __construct(Phynaster_Factory $factory, $key='id')
  {
    $this->foreignKey = $key;
  }

  public function foreignKey()
  {
    return $this->foreignKey;
  }
}
