<?php
/**
 * Copyright (c) 2011 Omer Hassan
 * Copyright (c) 2012 Ryan Parman
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Skyzyx\Components
{
	use DOMDocument,
	    DOMNode,
	    SimpleXMLElement;

	class Transmogrifier
	{
		const ATTRIBUTES = '__attributes__';
		const CONTENT = '__content__';

		/**
		 * Stores the name of the classname to generate an XML object with. Class must be, or extend, <\DOMDocument>.
		 */
		public static $class = '\DOMDocument';

		/**
		 * Converts an array into a DOMDocument-based XML object.
		 *
		 * @param array $source (Required) The array to convert into an XML object.
		 * @param string $root (Optional) The tag to use as the root of the XML document. The default value is <code>root</code>.
		 * @return DOMDocument An XML object.
		 */
		public static function array2dom(array $source, $root = 'root')
		{
			$document = new self::$class();
			$document->appendChild(self::createDOMElement($source, $root, $document));

			return $document;
		}

		/**
		 * Converts an array into an XML string.
		 *
		 * @param array $source (Required) The array to convert into an XML object.
		 * @param string $root (Optional) The tag to use as the root of the XML document. The default value is <code>root</code>.
		 * @param boolean $format (Optional) Whether or not to format the string. A value of <code>true</code> will pretty-print the string. A value of <code>false</code> will return the entire string on a single line. The default value is <code>true</code>.
		 * @return string An XML document.
		 */
		public static function array2xml(array $source, $root = 'root', $format = true)
		{
			$document = self::array2dom($source, $root);
			$document->formatOutput = $format;

			return $document->saveXML();
		}

		/**
		 * Converts a DOMDocument-based XML object into an array.
		 *
		 * @param DOMDocument $document (Required) The DOMDocument XML object to convert into an array.
		 * @return array An array representing the contents of the DOMDocument XML object.
		 */
		public static function dom2array(DOMDocument $document)
		{
			return self::create_array($document->documentElement);
		}

		/**
		 * Converts an XML string into an array.
		 *
		 * @param string $xml (Required) The XML string to convert into an array.
		 * @return array An array representing the contents of the XML string.
		 */
		public static function xml2array($xml)
		{
			$document = new self::$class();

			return $document->loadXML($xml) ? self::dom2array($document) : array();
		}

		/**
		 * Create a DOMDocument object from an array.
		 *
		 * @param mixed $source (Required) The source data to convert into a DOMDocument object.
		 * @param string $tag_name (Required) The element name to use for this node in the DOMDocument object.
		 * @param DOMDocument $document (Required) The DOMDocument object to work with.
		 * @return DOMNode A DOMNode object which can be imported as a DOM fragment into a DOMDocument element.
		 */
		private static function createDOMElement($source, $tag_name, DOMDocument $document)
		{
			if (!is_array($source))
			{
				$element = $document->createElement($tag_name);
				$element->appendChild($document->createCDATASection($source));

				return $element;
			}

			$element = $document->createElement($tag_name);

			foreach ($source as $key => $value)
			{
				if (is_string($key) && !is_numeric($key))
				{
					if ($key == self::ATTRIBUTES)
					{
						foreach ($value as $attributeName => $attributeValue)
						{
							$element->setAttribute($attributeName, $attributeValue);
						}
					}
					elseif ($key === self::CONTENT)
					{
						$element->appendChild($document->createCDATASection($value));
					}
					elseif (is_string($value) && !is_numeric($value))
					{
						$element->appendChild(self::createDOMElement($value, $key, $document));
					}
					elseif (is_array($value) && count($value))
					{
						$keyNode = $document->createElement($key);

						foreach ($value as $elementKey => $elementValue)
						{
							if (is_string($elementKey) && !is_numeric($elementKey))
							{
								$keyNode->appendChild(self::createDOMElement($elementValue, $elementKey, $document));
							}
							else
							{
								$element->appendChild(self::createDOMElement($elementValue, $key, $document));
							}
						}

						if ($keyNode->hasChildNodes())
						{
							$element->appendChild($keyNode);
						}
					}
					else
					{
						if (is_bool($value))
						{
							$value = $value ? 'true' : 'false';
						}

						$element->appendChild(self::createDOMElement((string) $value, $key, $document));
					}
				}
				else
				{
					$element->appendChild(self::createDOMElement($value, $tag_name, $document));
				}
			}

			return $element;
		}

		/**
		 * Converts a DOM node into an array.
		 *
		 * @param DOMNode $dom_node (Required) A DOMNode object to convert into an array.
		 * @return array An array that represents the contents of the DOMNode object.
		 */
		private static function create_array(DOMNode $dom_node)
		{
			$sxe = simplexml_import_dom($dom_node);
			return json_decode(json_encode($sxe), true);
		}
	}
}
