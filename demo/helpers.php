<?php
function generateGuid()
{
	return '00000000-0000-0000-0000-' . str_pad((string)getSequence(), 12, '0', STR_PAD_LEFT);
}

function getSequence()
{
  static $key = 0;
  return $key++;
}
