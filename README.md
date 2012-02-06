# Transmogrifier

This class transmogrifies arrays into DOMDocument XML objects, and vice-versa.


## Examples
Here's how you use it:

	require_once 'Transmogrifier.php';
	use Skyzyx\Components\Transmogrifier;

	$data = array(
		'book' => array(
			array(
				'author' => 'Author0',
				'title' => 'Title0',
				'publisher' => 'Publisher0',
				'__attributes__' => array(
					'isbn' => '978-3-16-148410-0'
				)
			),
			array(
				'author' => array('Author1', 'Author2'),
				'title' => 'Title1',
				'publisher' => 'Publisher1'
			),
			array(
				'__attributes__' => array(
					'isbn' => '978-3-16-148410-0'
				),
				'__content__' => 'Title2'
			)
		)
	);

	echo Transmogrifier::array2xml($data);

Which gives you the following:

	<?xml version="1.0"?>
	<root>
	  <book isbn="978-3-16-148410-0">
	    <author><![CDATA[Author0]]></author>
	    <title><![CDATA[Title0]]></title>
	    <publisher><![CDATA[Publisher0]]></publisher>
	  </book>
	  <book>
	    <author><![CDATA[Author1]]></author>
	    <author><![CDATA[Author2]]></author>
	    <title><![CDATA[Title1]]></title>
	    <publisher><![CDATA[Publisher1]]></publisher>
	  </book>
	  <book isbn="978-3-16-148410-0"><![CDATA[Title2]]></book>
	</root>

Check out the [tests](tree/master/tests) to get a sense of how it works.


## Installation
### Install source from GitHub
To install the source code:

	git clone git://github.com/skyzyx/transmogrifier.git

And include it in your scripts:

	require_once '/path/to/transmogrifier/Transmogrifier.php';

### Install with Composer
If you're using [Composer](https://github.com/composer/composer) to manage dependencies, you can add Transmogrifier with it.

	{
		"require": {
			"skyzyx/transmogrifier": "*"
		}
	}

### Using a Class Loader
If you're using a class loader (e.g., [Symfony Class Loader](https://github.com/symfony/ClassLoader)):

	$loader->registerNamespace('Skyzyx\\Components\\Transmogrifier', 'path/to/vendor/transmogrifier');


## Tests
Tests are written in [PHPT](http://qa.php.net/phpt_details.php) format. You can run them with either the PEAR Test Runner or with PHPUnit 3.6+.

	cd tests/
	pear run-tests .

...or...

	cd tests/
	phpunit .


## License & Copyright
Copyright (c) 2010-2011 [Omer Hassan](https://code.google.com/u/113495690012051782542/). Copyright (c) 2012 [Ryan Parman](http://ryanparman.com). Licensed for use under the terms of the [MIT license](http://www.opensource.org/licenses/mit-license.php).
