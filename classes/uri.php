<?php

class Uri extends Fuel\Core\Uri
{

	public static function referrer()
	{
		$referrer = Input::referrer();
		if ($referrer and (strpos($referrer, Uri::base()) === 0))
		{
			return $referrer;
		}

		return false;
	}

}
