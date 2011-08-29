Phynaster
=============================

A library for quickly and easily creating database data for use in automated testing.

Why?
-----------------------------

To my surprise, coming from the Ruby world in which many such libraries exist, none seem to exist to handle creating complex data full of associations, defaults, and sequences for quick testing. Enter **Phynaster**.

How?
-----------------------------

The `demo` folder of the project contains full examples (basically a wishlist that I made work) but for a brief example:

_tests/factories.php_

    Phynaster::define('Comment', array(
        'defaults' => array(
            'name' => 'This is awesome!',
            'user' => Phynaster::association('User'),
            'post' => Phynaster::association('Post')),
        'adapter' => Phynaster::adapter('Zend', new Application_Model_DbTable_Comment)
    );

    $comment = Phynaster::create('Comment'); => populates the specified comment, user and post tables

What's next
-----------------------------

* Proper support for more association types (has one, has and belongs to many)
* Helpers for things like timestamps, sequences, and guids
