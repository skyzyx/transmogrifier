--TEST--
Use multiple nodes with identical names as children of <root>.

--FILE--
<?php
require_once dirname(__DIR__) . '/Transmogrifier.php';

use Skyzyx\Components\Transmogrifier;

$data = array(
	'domainInfos' => array(
		array(
			'name' => 'aws-php-sdk-domain',
			'status' => 'REGISTERED'
		),
		array(
			'name' => 'aws-php-sdk-domain2',
			'status' => 'REGISTERED'
		)
	)
);

echo Transmogrifier::array2xml($data);
?>

--EXPECT--
<?xml version="1.0"?>
<root>
  <domainInfos>
    <name><![CDATA[aws-php-sdk-domain]]></name>
    <status><![CDATA[REGISTERED]]></status>
  </domainInfos>
  <domainInfos>
    <name><![CDATA[aws-php-sdk-domain2]]></name>
    <status><![CDATA[REGISTERED]]></status>
  </domainInfos>
</root>
