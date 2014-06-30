--TEST--
Empty nodes in the JSON document (inner).

--FILE--
<?php
require_once '../src/Skyzyx/Components/Transmogrifier.php';

use Transmogrifier\Transmogrifier;

$data = json_decode('{
  "data1": {
    "full": ["one","two"],
    "empty":[]
  },
  "data2": {
    "full": {
      "one":"two"
    },
    "empty":{}
  }
}', true);

echo Transmogrifier::toXML($data);
?>

--EXPECT--
<?xml version="1.0"?>
<root>
  <data1>
    <full><![CDATA[one]]></full>
    <full><![CDATA[two]]></full>
    <empty/>
  </data1>
  <data2>
    <full>
      <one><![CDATA[two]]></one>
    </full>
    <empty/>
  </data2>
</root>
