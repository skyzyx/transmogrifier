<?php
/**
 * @author Omer Hassan
 */
class DOM
{
  /**
   * @param array $source
   * This source array:
   *
   * Array
   * (
   *   [book] => Array
   *     (
   *       [0] => Array
   *         (
   *           [author] => Author0
   *           [title] => Title0
   *           [publisher] => Publisher0
   *         )
   *       [1] => Array
   *         (
   *           [author] => Array
   *             (
   *               [0] => Author1
   *               [1] => Author2
   *             )
   *           [title] => Title1
   *           [publisher] => Publisher1
   *         )
   *     )
   * )
   *
   * will produce this XML:
   *
   * <root>
   *   <book>
   *     <author>Author0</author>
   *     <title>Title0</title>
   *     <publisher>Publisher0</publisher>
   *   </book>
   *   <book>
   *     <author>Author1</author>
   *     <author>Author2</author>
   *     <title>Title1</title>
   *     <publisher>Publisher1</publisher>
   *   </book>
   * </root>
   * @param string $rootTagName
   * @return DOMDocument
   */
  public static function arrayToDOMDocument(array $source, $rootTagName = 'root')
  {
    $document = new DOMDocument();
    $document->appendChild(self::createDOMElement($source, $rootTagName, $document));

    return $document;
  }

  /**
   * @param array $source
   * @param string $rootTagName
   * @param bool $formatOutput
   * @return string
   */
  public static function arrayToXMLString(array $source, $rootTagName = 'root', $formatOutput = true)
  {
    $document = self::arrayToDOMDocument($source, $rootTagName);
    $document->formatOutput = $formatOutput;
    return $document->saveXML();
  }

  private static function createDOMElement($source, $tagName, DOMDocument $document)
  {
    if (!is_array($source))
      return $document->createElement($tagName, $source);

    $element = $document->createElement($tagName);

    foreach ($source as $key => $value)
      if (is_string($key))
        foreach ((is_array($value) ? $value : array($value)) as $elementKey => $elementValue)
          $element->appendChild(self::createDOMElement($elementValue, $key, $document));
      else
        $element->appendChild(self::createDOMElement($value, $tagName, $document));
      
    return $element;
  }
}