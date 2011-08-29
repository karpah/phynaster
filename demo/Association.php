<?php
require_once 'lib/Phynaster.php';

Phynaster::define('Post', array(
  'defaults' => array(
    'id' => Phynaster::sequence('id'),
    'name' => 'Post ' . Phynaster::sequence('name')
  )
));

Phynaster::define('Comment', array(
  'defaults' => array(
    'name' => 'Comment ' . Phynaster::sequence('comment'),
    'post_id' => Phynaster::association('Post')
  )
));

var_dump(Phynaster::create('Comment'));
