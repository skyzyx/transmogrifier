# Transmogrifier

Magically transmogrifies arrays into XML documents.


## Requirements
### Required
The following software is **required** for Transmogrifier to run:

* [PHP](http://php.net) 5.3.2+

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

	echo Transmogrifier::to_xml($data);

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


## Installation
Depending on your needs, there are a few different ways you can install Transmogrifier:

### Bundle with Composer
To add Transmogrifier as a [Composer](https://github.com/composer/composer) dependency in your `composer.json` file:

	{
		"require": {
			"skyzyx/transmogrifier": ">=1.0"
		}
	}

### Install source from GitHub
To install the source code for Transmogrifier:

	git clone git://github.com/skyzyx/transmogrifier.git
	cd transmogrifier
	wget --quiet http://getcomposer.org/composer.phar
	php composer.phar install

And include it in your scripts:

	require_once '/path/to/transmogrifier/src/Skyzyx/Components/Transmogrifier.php';

### Install source from zip/tarball
Alternatively, you can fetch a [tarball](https://github.com/skyzyx/transmogrifier/tarball/master) or [zipball](https://github.com/skyzyx/transmogrifier/zipball/master):

    $ curl https://github.com/skyzyx/transmogrifier/tarball/master | tar xzv
    (or)
    $ wget https://github.com/skyzyx/transmogrifier/tarball/master -O - | tar xzv

And include it in your scripts:

	require_once '/path/to/transmogrifier/src/Skyzyx/Components/Transmogrifier.php';

### Using a Class Loader
If you're using a class loader (e.g., [Symfony Class Loader](https://github.com/symfony/ClassLoader)) for [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)-style class loading:

	$loader->registerNamespace('Skyzyx\\Components\\Transmogrifier', 'path/to/vendor/skyzyx/transmogrifier/src/Skyzyx/Components/Transmogrifier');


## Contributing
To view the list of existing [contributors](/skyzyx/transmogrifier/contributors), run the following command from the Terminal:

	git shortlog -sne --no-merges

### How?
Here's the process for contributing:

1. Fork Transmogrifier to your GitHub account.
2. Clone your GitHub copy of the repository into your local workspace.
3. Write code, fix bugs, and add tests with 100% code coverage.
4. Commit your changes to your local workspace and push them up to your GitHub copy.
5. You submit a GitHub pull request with a description of what the change is.
6. The contribution is reviewed. Maybe there will be some banter back-and-forth in the comments.
7. If all goes well, your pull request will be accepted and your changes are merged in.
8. You will become "Internet famous" with anybody who runs `git shortlog` from the Terminal. :)

To simplify many aspects of development, we also have a `build.xml` for Phing. The easiest way to install Phing and any other dependencies is to install [Phix](http://phix-project.org/#install).


## Testing
[![Build Status](https://secure.travis-ci.org/skyzyx/transmogrifier.png)](http://travis-ci.org/skyzyx/transmogrifier)

Requests strives to have 100% code-coverage of the library with an extensive set of tests. We're not quite there yet, but we're getting close.

### Unit tests
Our unit tests are written in [PHPT](http://qa.php.net/phpt_details.php) format. You can run them with either the PEAR Test Runner or with [PHPUnit](https://github.com/sebastianbergmann/phpunit/) 3.6+.

	cd tests/
	pear run-tests -r .

...or...

	cd tests/
	phpunit .

### Integration tests
Our integration tests use PHPUnit.

	cd tests/
	phpunit .

### Code Coverage
You can generate a code coverage report with the following command. You'll need the [Xdebug](http://xdebug.org) extension installed:

	cd tests/
	phpunit --coverage-html ./_coverage_report .


## Authors, Copyright & Licensing

* Copyright (c) 2010-2012 [Ryan Parman](http://ryanparman.com).
* Copyright (c) 2012 Amazon.com, Inc. or its affiliates.

See also the list of [contributors](/skyzyx/transmogrifier/contributors) who participated in this project.

Licensed for use under the terms of the [MIT license](http://www.opensource.org/licenses/mit-license.php).
