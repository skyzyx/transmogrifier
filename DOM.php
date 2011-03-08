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
   * <code>
   * Array
   * (
   *   [book] => Array
   *     (
   *       [0] => Array
   *         (
   *           [author] => Author0
   *           [title] => Title0
   *           [publisher] => Publisher0
   *           [__attributes__] => Array
   *             (
   *               [isbn] => 978-3-16-148410-0
   *             )
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
   *       [2] => Array
   *         (
   *           [__attributes__] => Array
   *             (
   *               [isbn] => 978-3-16-148410-0
   *             )
   *           [__content__] => Title2
   *         )
   *     )
   * )
   * </code>
   *
   * will produce this XML:
   *
   * <code>
   * <root>
   *   <book isbn="978-3-16-148410-0">
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
   *   <book isbn="978-3-16-148410-0">Title2</book>
   * </root>
   * </code>
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
    {
      $element = $document->createElement($tagName);
      $element->appendChild($document->createCDATASection($source));

      return $element;
    }

    $element = $document->createElement($tagName);

    foreach ($source as $key => $value)
      if (is_string($key))
        if ($key == '__attributes__')
          foreach ($value as $attributeName => $attributeValue)
            $element->setAttribute($attributeName, $attributeValue);
        else if ($key == '__content__')
          $element->appendChild($document->createCDATASection($value));
        else
          foreach ((is_array($value) ? $value : array($value)) as $elementKey => $elementValue)
            $element->appendChild(self::createDOMElement($elementValue, $key, $document));
      else
        $element->appendChild(self::createDOMElement($value, $tagName, $document));

    return $element;
  }
}