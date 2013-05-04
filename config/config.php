<?php

ini_set('default_charset', 'UTF-8');

return array(
	'language' => 'ja',
	'locale' => 'ja_JP.utf8',
	'default_timezone' => 'Asia/Tokyo',
	'always_load' => array(
		'packages' => array(
			//'orm',
		),
		'config' => array(
		),
	),

	'security' => array(
		'uri_filter' => array('htmlentities'),
		'output_filter' => array('Security::htmlentities'),
		'whitelisted_classes' => array(
			'Fuel\\Core\\Response',
			'Fuel\\Core\\View',
			'Fuel\\Core\\ViewModel',
			'Closure',
		),
	),

);
