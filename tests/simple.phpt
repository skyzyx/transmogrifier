--TEST--
Use multiple nodes with identical names as children of <root>.

--FILE--
<?php
require_once '../src/Skyzyx/Components/Transmogrifier.php';

use Skyzyx\Components\Transmogrifier;

$data = json_decode('{"count":1,"truncated":false}', true);

echo Transmogrifier::to_xml($data);
?>

--EXPECT--
<?xml version="1.0"?>
<root>
  <count>1</count>
  <truncated><![CDATA[false]]></truncated>
</root>
