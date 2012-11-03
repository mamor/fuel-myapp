<?php

class My_Func
{

	public static function errors_to_array(Validation_Error $errors)
	{
		$messages = array();
		foreach ($errors as $error)
		{
			$messages[] = $error->__toString();
		}
		return $messages;
	}

}
