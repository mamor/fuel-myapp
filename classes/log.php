<?php

class Log extends Fuel\Core\Log
{
	public static function i($msg, $method = null)
	{
		return parent::info( ! is_scalar($msg) ? print_r($msg, true) : $msg, $method);
	}

	public static function d($msg, $method = null)
	{
		return parent::debug( ! is_scalar($msg) ? print_r($msg, true) : $msg, $method);
	}

	public static function w($msg, $method = null)
	{
		return parent::warning( ! is_scalar($msg) ? print_r($msg, true) : $msg, $method);
	}

	public static function e($msg, $method = null)
	{
		return parent::error( ! is_scalar($msg) ? print_r($msg, true) : $msg, $method);
	}
}
