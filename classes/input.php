<?php

class Input extends Fuel\Core\Input
{

	/**
	 * Return's whether this is an PJAX request or not
	 *
	 * @return  bool
	 */
	public static function is_pjax()
	{
		return static::server('HTTP_X_PJAX') !== null;
	}

}
