--TEST--
Empty nodes in the JSON document (outer).

--FILE--
<?php
require_once '../src/Skyzyx/Components/Transmogrifier.php';

use Skyzyx\Components\Transmogrifier;

$data = json_decode('{"data1":[],"data2":{}}', true);

echo Transmogrifier::to_xml($data);
?>

--EXPECT--
<?xml version="1.0"?>
<root>
  <data1/>
  <data2/>
</root>
