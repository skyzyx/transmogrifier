--TEST--
Test a sample response from DynamoDB.

--FILE--
<?php
require_once '../src/Skyzyx/Components/Transmogrifier.php';

use Transmogrifier\Transmogrifier;

$data = array(
	'Attributes' => array(
		'name' => array(
			'S' => 'new name',
		),
		'strings' => array(
			'SS' => array(
				0 => 'one',
				1 => 'two',
			),
		),
	),
	'ConsumedCapacityUnits' => 1,
);

echo Transmogrifier::toXML($data);
?>

--EXPECT--
<?xml version="1.0"?>
<root>
  <Attributes>
    <name>
      <S><![CDATA[new name]]></S>
    </name>
    <strings>
      <SS><![CDATA[one]]></SS>
      <SS><![CDATA[two]]></SS>
    </strings>
  </Attributes>
  <ConsumedCapacityUnits>1</ConsumedCapacityUnits>
</root>
