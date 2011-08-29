Phynaster
=============================

A library for quickly and easily creating database data for use in automated testing.

Why?
-----------------------------

When writing unit tests, you want to focus on the code you're testing, not setting up the required data structures required to test it. Enter **Phynaster**.

No object is an island; it all has associations, defaults, sequences and constraints that must be satisfied before the real testing can begin. Get all of that out of the way with Phynaster factories - define default values for each new object you want
to generate, and in your test only specify the data that is relevant to that specific test.

Populate as much nested data as you want, with just a few quick function calls.

How?
-----------------------------

The `demo` folder of the project contains several full examples (a wishlist that I made work) but for a brief example:

_tests/factories.php_

    Phynaster::define('User', array(
      'defaults' => array(
        'guid' => Phynaster::guid(),
      ),
      'adapter' => Phynaster::adapter('Zend', new Application_Model_DbTable_User)
    ));

    Phynaster::define('Article', array(
      'defaults' => array(
        'name' => 'Test Article #' . Phynaster::sequence('name')
      ),
      'adapter' => Phynaster::adapter('Zend', new Application_Model_DbTable_Article)
    ));

    Phynaster::define('Comment', array(
      'defaults' => array(
        'name' => 'This is awesome!',
        'userId' => Phynaster::association('User'),
        'postId' => Phynaster::association('Article')
      ),
      'adapter' => Phynaster::adapter('Zend', new Application_Model_DbTable_Comment)
    ));


_tests/ImportantTest.php_

    function setUp()
    {
      $comment = Phynaster::create('Comment', array('name' => 'Super awesome comment'));
    }

And just like that, you have valid data and database records for a user, an article, and a comment. Factories can be reused, data in them can be tailored to each test's need, and gone are the days of updating one piece of test data and breaking all your existing tests. (It's happened to all of us.)

What's next
-----------------------------

* Proper support for more association types (has one, has and belongs to many)
* More helpers for things like timestamps

Licensing
-----------------------------

Do whatever you want with Phynaster, it's covered by an MIT license.

http://www.opensource.org/licenses/MIT
