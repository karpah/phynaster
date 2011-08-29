<?php
require_once 'helpers.php';
require_once 'lib/Phynaster.php';

Phynaster::define('Post', array(
  'defaults' => array(
    'id' => getSequence(),
    'name' => 'Post ' . getSequence()
  )
));

Phynaster::define('Comment', array(
  'defaults' => array(
    'name' => 'Comment ' . getSequence(),
    'post_id' => Phynaster::association('Post')
  )
));

var_dump(Phynaster::create('Comment'));
