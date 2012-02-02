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


## Composer
If you're using [Composer](https://github.com/composer/composer) to manage dependencies, you can add Transmogrifier with it.

	{
		"require": {
			"skyzyx/transmogrifier": "*"
		}
	}


## Tests
Tests are written in [PHPT](http://qa.php.net/phpt_details.php) format. You can run them with either the PEAR Test Runner or with PHPUnit 3.6+.

	cd tests/
	pear run-tests .

...or...

	cd tests/
	phpunit .


## License
* Portions copyright 2010-2011 [Omer Hassan](https://code.google.com/u/113495690012051782542/)
* Portions copyright 2012 [Ryan Parman](http://ryanparman.com)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

<http://opensource.org/licenses/mit-license.php>
