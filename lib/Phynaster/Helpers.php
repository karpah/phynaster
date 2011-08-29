<?php
class Phynaster_Helpers
{
  protected static $sequences;

  /**
   * Replace the placeholder helper calls with their actual values.
   * This is done so sequences can be defined at factory define time, but
   * only evaluated at create time.
   * @param string $value
   */
  public static function evaluate(&$value)
  {
    if( preg_match("/##(.*)\((.*)\)##/i", $value, $matches) )
    {
      // Evaluate the helper
      // $matches[1] will be something like 'getSequence' or 'getGuid'
      $helper = call_user_func_array(array('self', $matches[1]), array($matches[2]));

      // And put it back in the value
      $value = str_replace($matches[0], $helper, $value);
    }
  }

  /**
   * Define a new sequence for a factory.
   * The default sequence key is 'default'.
   * @return string The parameterized sequence key.
   */
  public static function sequence($key='default')
  {
    self::$sequences[$key] = 1;
    return "##getSequence('$key')##";
  }


  /**
   * Instantiate a sequence, calculating its value.
   * @param string The sequence key
   * @return int
   */
  public static function getSequence($key)
  {
    if( !array_key_exists($key, self::$sequences) )
      $key = 'default';

    return self::$sequences[$key]++;
  }

  // Clear all defined sequences.
  public static function clearSequences()
  {
    self::$sequences = array();
  }
}
