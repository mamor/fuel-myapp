<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * If you want to override the default configuration, add the keys you
 * want to change here, and assign new values to them.
 */

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
);
