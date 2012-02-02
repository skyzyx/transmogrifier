--TEST--
Use multiple nodes with identical names as children of <root>.

--FILE--
<?php
require_once dirname(__DIR__) . '/Transmogrifier.php';

use Skyzyx\Components\Transmogrifier;

$data = json_decode('{"count":1,"truncated":false}', true);

echo Transmogrifier::array2xml($data);
?>

--EXPECT--
<?xml version="1.0"?>
<root>
  <count><![CDATA[1]]></count>
  <truncated><![CDATA[false]]></truncated>
</root>
