<?php

class My_Smiley
{

	private static $smileys = array(
		':)', '(:', ':p', ':b', 'q:', 'd:', 'xD', ':@', '@:',
		'(｡･ˇ_ˇ･｡)',
	);

	public static function random()
	{
		return static::$smileys[array_rand(array_keys(static::$smileys))];
	}

}
