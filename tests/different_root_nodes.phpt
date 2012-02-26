--TEST--
Use multiple nodes with different names as children of <root>.

--FILE--
<?php
require_once dirname(__DIR__) . '/src/Skyzyx/Components/Transmogrifier.php';

use Skyzyx\Components\Transmogrifier;

$data = array(
	'configuration' => array(
		'workflowExecutionRetentionPeriodInDays' => 1
	),
	'domainInfo' => array(
		'name' => 'aws-php-sdk-domain',
		'status' => 'REGISTERED'
	)
);

echo Transmogrifier::array2xml($data);
?>

--EXPECT--
<?xml version="1.0"?>
<root>
  <configuration>
    <workflowExecutionRetentionPeriodInDays><![CDATA[1]]></workflowExecutionRetentionPeriodInDays>
  </configuration>
  <domainInfo>
    <name><![CDATA[aws-php-sdk-domain]]></name>
    <status><![CDATA[REGISTERED]]></status>
  </domainInfo>
</root>
