<?php

class Input extends Fuel\Core\Input
{

	/**
	 * Return's whether this is an PJAX request or not
	 *
	 * @return bool
	 */
	public static function is_pjax()
	{
		return static::server('HTTP_X_PJAX') !== null;
	}

	/**
	 * Return's php://input
	 *
	 * @return php://input
	 */
	public static function php_input()
	{
		static::$php_input === null and static::$php_input = file_get_contents('php://input');
		return static::$php_input;
	}
}
