<?php
require_once 'helpers.php';
require_once 'lib/Phynaster.php';
require_once 'Zend/Db/Table.php';
require_once 'Zend/Db/Adapter/Pdo/Sqlite.php';

class MemberTable extends Zend_Db_Table {}

$adapter = new Zend_Db_Adapter_Pdo_Sqlite(array('dbname' => 'test'));
Zend_Db_Table_Abstract::setDefaultAdapter($adapter);

Phynaster::define('Member',
  array(
    'defaults' => array(
			'name' => 'Test ' . getSequence(),
    	'guid' => generateGuid(),
    	'isGroup' => false
    ),
    'adapter' => new MemberTable,
  )
);

var_dump(Phynaster::create('Member'));
