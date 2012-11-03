<?php

class My_Func
{

	public static function errors_to_array($errors)
	{
		$messages = array();
		foreach ($errors as $error)
		{
			$messages[] = $error->__toString();
		}
		return $messages;
	}

}
